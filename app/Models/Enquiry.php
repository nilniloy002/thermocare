<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['enquiry_type', 'name', 'organization', 'contact', 'service_interest', 'project_type', 'location', 'message'];
}
