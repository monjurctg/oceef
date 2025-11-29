<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CelebrationRegistration extends Model
{
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
    ];

    protected $casts = [
        'has_driver' => 'boolean',
        'family_members' => 'integer',
        'children_count' => 'integer',
        'has_children_under_five' => 'boolean',
        'attend_wednesday_night' => 'boolean',
        'amount' => 'decimal:2',
    ];
}