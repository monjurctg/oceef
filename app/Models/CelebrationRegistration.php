<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CelebrationRegistration extends Model
{
    // If your table name differs, set it here:
    protected $table = 'celebration_registrations';

    // Fillable attributes (adjust as needed)
    protected $fillable = [
        'name',
        'mobile_num',
        'email',
        'address',
        'emergency_contact',
        'family_members',
        'children_count',
        'has_driver',
        'nid',
        'bncc_batch',
        'religion',
        'has_children_under_five',
        'attend_wednesday_night',
        'passport_photo',
        'payment_method',
        'transaction_number',
        'transaction_screenshot',
        'amount',
        'cashout_fee',
    ];

    // If you store timestamps differently:
    public $timestamps = true;

    // Optional: cast registered_at to datetime
    protected $casts = [
        'registered_at' => 'datetime',
        'cashout_fee' => 'decimal:2',
        'amount' => 'decimal:2',
        'has_driver' => 'boolean',
        'has_children_under_five' => 'boolean',
        'attend_wednesday_night' => 'boolean',
        'family_members' => 'integer',
        'children_count' => 'integer',
    ];
}