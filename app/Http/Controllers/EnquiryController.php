<?php

namespace App\Http\Controllers;

use App\Mail\ConsultationRequested;
use App\Models\EmailLog;
use App\Models\Enquiry;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $enquiry = Enquiry::create($request->validate([
            'enquiry_type' => ['nullable', 'in:contact,consultation'],
            'name' => ['required', 'string', 'max:120'],
            'organization' => ['nullable', 'string', 'max:120'],
            'contact' => ['required', 'string', 'max:150'],
            'service_interest' => ['nullable', 'string', 'max:120'],
            'project_type' => ['nullable', 'string', 'max:120'],
            'location' => ['nullable', 'string', 'max:120'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]));

        $recipient = SiteSetting::where('key', 'email')->value('value') ?: config('mail.from.address');
        $subject = $enquiry->enquiry_type === 'consultation' ? 'New consultation request' : 'New website enquiry';

        try {
            Mail::to($recipient)->send(new ConsultationRequested($enquiry, $subject));
            EmailLog::create(['enquiry_id' => $enquiry->id, 'recipient' => $recipient, 'subject' => $subject, 'status' => 'sent']);
        } catch (\Throwable $exception) {
            EmailLog::create(['enquiry_id' => $enquiry->id, 'recipient' => $recipient, 'subject' => $subject, 'status' => 'failed', 'error_message' => $exception->getMessage()]);
        }

        return back()->with('success', 'Thank you. Our engineering team will be in touch shortly.');
    }
}
