<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PickupPerson;
use App\Models\PickupLogin;
use Illuminate\Support\Facades\Http;



class PickupLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function sendOtp(Request $request)
    {
        $request->validate([
            'contact_no' => 'required|digits:10',
        ]);

        $otp = rand(100000, 999999);
        $contact_no = $request->contact_no;
        
        DB::table('pickup_otps')->updateOrInsert(
            ['contact_no' => $contact_no],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $response = Http::withHeaders([
            'authorization' => env('FAST2SMS_API_KEY'),
        ])->post('https://www.fast2sms.com/dev/bulkV2', [
            'route' => 'q', // or 'otp' depending on template
            'message' => "Your OTP is $otp", // Use your approved template if required
            'language' => 'english',
            'flash' => 0,
            'numbers' => $contact_no,
            'sender_id' => 'TXTIND',
        ]);

        // Optionally log for debugging
        // \Log::info('Fast2SMS response: ' . $response);
        // dd($response->body());


        
        session(['pickup_contact_no' => $contact_no]);
        
        return redirect()->route('pickup.otp.form');
        
    }
    public function showOtpForm()
    {
        return view('otpverify');
    }
    
    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $contact_no = session('pickup_contact_no'); // ✅ get from session

        if (!$contact_no) {
            return back()->withErrors(['otp' => 'Session expired. Please request OTP again.']);
        }

        $record = DB::table('pickup_otps')
            ->where('contact_no', $contact_no)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        $pickup = PickupPerson::where('contact_no', $contact_no)->first();

        if (!$pickup) {
            return back()->withErrors(['otp' => 'Pickup person not found']);
        }

        PickupLogin::create([
            'pickup_person_id' => $pickup->id,
            'contact_no' => $pickup->contact_no,
            'logged_in_at' => now(),
        ]);

        DB::table('pickup_otps')->where('contact_no', $contact_no)->delete();

        session(['pickup_id' => $pickup->id]);

        return redirect()->route('child.profile');
    }




}
