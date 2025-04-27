<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPerson extends Model
{
    use HasFactory;
    protected $table = 'pickup_persons';

    protected $fillable = [
        'child_id',
        'name',
        'relation',
        'contact_no',
    ];
}