@php
    $contact = \App\Models\SiteSetting::whereIn('key', ['address', 'chattogram_address', 'contact_email', 'phone', 'phone_secondary'])->pluck('value', 'key');
@endphp
<div class="space-y-5 text-sm" style="overflow-wrap: anywhere">
    <div><h3 class="font-bold">Dhaka Office</h3><p class="mt-2">{{ $contact['address'] ?? 'House-2B, (3rd Floor), Road-08, Nikunja-02, Dhaka-1229, Bangladesh' }}</p></div>
    <div><h3 class="font-bold">Chattogram Office</h3><p class="mt-2">{{ $contact['chattogram_address'] ?? '79/A Matro Plaza (5th Floor), Sadarghat Kalibari Moor, Chattogram.' }}</p></div>
    <div><a class="block" href="mailto:{{ $contact['contact_email'] ?? 'thermocarebd@gmail.com' }}">{{ $contact['contact_email'] ?? 'thermocarebd@gmail.com' }}</a>
    @foreach ([$contact['phone'] ?? '+88 01828 009 393', $contact['phone_secondary'] ?? '+88 01711 714 740'] as $phone)
        @if ($phone)<a class="mt-2 block" href="tel:{{ preg_replace('/[^+0-9]/', '', $phone) }}">{{ $phone }}</a>@endif
    @endforeach
    <a class="mt-2 block" href="https://www.thermocarebd.com">www.thermocarebd.com</a></div>
</div>
