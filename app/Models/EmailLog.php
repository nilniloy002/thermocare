<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = ['enquiry_id', 'recipient', 'subject', 'status', 'error_message'];
}
