<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = [
        'date_create',
        'due_date',
        'carp_code',
        'category',
        'initiator',
        'initiator_div',
        'initiator_branch',
        'recipient',
        'recipient_div',
        'recipient_branch',
        'verified_by',
        'effectiveness',
        'status_date',
        'stage',
        'status',
       ];
}
