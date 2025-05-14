<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\PickupPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ChildController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // Validate Child Data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'class' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'zip_code' => 'required|digits:7',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:1024', // 1 MB
            'pickup_name' => 'required|array|min:1|max:6',
            'pickup_relation' => 'required|array|min:1|max:6',
            'pickup_contact' => 'required|array|min:1|max:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Save Photo
        $photoPath = $request->file('photo')->store('photos', 'public');

        // Save Child
        $child = Child::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'class' => $request->class,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
            'photo' => $photoPath,
        ]);

        // Save Pickup Persons
        foreach ($request->pickup_name as $key => $name) {
            PickupPerson::create([
                'child_id' => $child->id,
                'name' => $name,
                'relation' => $request->pickup_relation[$key],
                'contact_no' => $request->pickup_contact[$key],
            ]);
        }

        return redirect()->back()->with('success', 'Child Registered Successfully!');

    }
    public function profile()
    {
        $childprofile=Child::get();
        $pickupperson=PickupPerson::get();
        return view('profileview',compact('childprofile','pickupperson'));
    }
    
}

