<x-mail::message>
# New {{ $enquiry->enquiry_type === 'consultation' ? 'consultation request' : 'website enquiry' }}

**Name:** {{ $enquiry->name }}

**Organisation:** {{ $enquiry->organization ?: 'Not provided' }}

**Contact:** {{ $enquiry->contact }}

**Service interest:** {{ $enquiry->service_interest ?: 'Not provided' }}

**Project type:** {{ $enquiry->project_type ?: 'Not provided' }}

**Location:** {{ $enquiry->location ?: 'Not provided' }}

**Message:**

{{ $enquiry->message ?: 'Not provided' }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
