@php
  $contact = \App\Models\SiteSetting::whereIn('key', ['address', 'chattogram_address', 'contact_email', 'phone', 'phone_secondary'])->pluck('value', 'key');
@endphp
<footer class="site-footer footer-refined">
  <div class="container-page footer-main">
    <div class="footer-intro"><a href="{{ route('home') }}"><img src="{{ $brandLightUrl }}" class="footer-brand-logo" width="834" height="232" alt="Thermo-Care Engineering Limited"></a><p>Industrial HVAC and refrigeration engineering services for dependable operations.</p></div>
    <div><h3 class="font-black text-white">Services</h3>
      @foreach (['Refrigeration', 'Air Conditioning', 'Ventilation', 'Maintenance'] as $service)
        <a class="mt-3 block text-sm" href="{{ route('services') }}">{{ $service }}</a>
      @endforeach
    </div>
    <div><h3 class="font-black text-white">Products</h3>
      @foreach (['compressor' => 'Compressors', 'condenser' => 'Condensers', 'evaporator' => 'Evaporators', 'freezing-systems' => 'Freezing Systems', 'chilled-water-systems' => 'Chilled Water Systems', 'sandwich-panels' => 'Sandwich Panels'] as $slug => $label)
        <a class="mt-3 block text-sm" href="{{ route('product-page', ['slug' => $slug]) }}">{{ $label }}</a>
      @endforeach
    </div>
    <div class="footer-offices"><h3 class="font-black text-white">Our Offices</h3>
      <div><h4>Dhaka</h4><p>{{ $contact['address'] ?? '' }}</p></div>
      <div><h4>Chattogram</h4><p>{{ $contact['chattogram_address'] ?? '' }}</p></div>
    </div>
  </div>
  <div class="container-page"><div class="footer-contact-bar">
    <a href="mailto:{{ $contact['contact_email'] ?? '' }}"><span>Email us</span>{{ $contact['contact_email'] ?? '' }}</a>
    <div><span>Call our team</span><div class="footer-phones">@foreach ([$contact['phone'] ?? '', $contact['phone_secondary'] ?? ''] as $phone) @if ($phone)<a href="tel:{{ preg_replace('/[^+0-9]/', '', $phone) }}">{{ $phone }}</a>@endif @endforeach</div></div>
    <a class="footer-contact-link" href="{{ route('contact') }}">Get in touch <span aria-hidden="true">↗</span></a>
  </div></div>
  <div class="border-t border-white/10 py-5"><div class="container-page flex flex-col justify-between gap-3 text-sm text-slate-400 md:flex-row"><span>© {{ date('Y') }} Thermo-Care Engineering Limited. All rights reserved.</span><span><a href="{{ route('privacy-policy') }}">Privacy Policy</a> · <a href="{{ route('contact') }}">Contact Us</a> · <a href="{{ route('sitemap') }}">Sitemap</a></span></div></div>
</footer>
