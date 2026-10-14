@php
  $details = \App\Models\SiteSetting::whereIn('key', ['address','chattogram_address','contact_email','phone','phone_secondary'])->pluck('value','key');
@endphp
<main class="contact-page">
  <section class="inner-hero contact-hero text-white" style="--hero-img:url('/images/hero-cold-storage.png')">
    <div class="container-page"><nav aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span aria-hidden="true"> / </span>Contact Us</nav><p class="contact-eyebrow">LET’S TALK ABOUT YOUR PROJECT</p><h1>Contact our team</h1><p>From a first enquiry to ongoing support, we’re here to help with your cooling requirements.</p></div>
  </section>
  <section class="contact-section"><div class="container-page contact-layout">
    <aside class="contact-info" aria-label="Contact information">
      <p class="contact-eyebrow">GET IN TOUCH</p><h2>Engineering starts<br>with a conversation.</h2><p class="contact-intro">Tell us what you need. Contact our team directly or send an enquiry using the form.</p>
      <div class="office-card"><i data-lucide="map-pin" aria-hidden="true"></i><div><h3>Dhaka Office</h3><p>{{ $details['address'] }}</p><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($details['address']) }}" target="_blank" rel="noopener noreferrer">View on map ↗</a></div></div>
      <div class="office-card"><i data-lucide="map-pin" aria-hidden="true"></i><div><h3>Chattogram Office</h3><p>{{ $details['chattogram_address'] }}</p><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($details['chattogram_address']) }}" target="_blank" rel="noopener noreferrer">View on map ↗</a></div></div>
      <div class="contact-direct"><div><i data-lucide="mail" aria-hidden="true"></i><div><h3>Email us</h3><a href="mailto:{{ $details['contact_email'] }}">{{ $details['contact_email'] }}</a></div></div><div><i data-lucide="phone" aria-hidden="true"></i><div><h3>Call our team</h3>@foreach ([$details['phone'], $details['phone_secondary']] as $phone)<a href="tel:{{ preg_replace('/[^+0-9]/', '', $phone) }}">{{ $phone }}</a>@endforeach</div></div></div>
    </aside>
    <div class="contact-form-card" id="enquiry-form">
      <div class="contact-form-heading"><p class="contact-eyebrow">SEND AN ENQUIRY</p><h2>How can we help?</h2><p>Share a few details and our team will get in touch. Fields marked * are required.</p></div>
      @if(session('success'))<div class="contact-notice contact-success" role="status" tabindex="-1">{{ session('success') }}</div>@endif
      @if($errors->any())<div class="contact-notice contact-error" role="alert" tabindex="-1">Please check the highlighted fields and send your enquiry again.</div>@endif
      <form method="POST" action="{{ route('enquiries.store') }}" class="contact-form" id="contact-enquiry">
        @csrf<input type="hidden" name="enquiry_type" value="contact">
        <div class="contact-fields">
          @foreach (['name' => ['Full name', 'Your full name', 'name', true], 'organization' => ['Company / organization', 'Company name (optional)', 'organization', false], 'contact' => ['Email or phone', 'Your email address or phone number', 'email', true]] as $key => [$label, $placeholder, $autocomplete, $required])
          <div class="contact-field {{ $key === 'contact' ? 'contact-full' : '' }}"><label for="enquiry-{{ $key }}">{{ $label }} @if($required)<span aria-hidden="true">*</span>@endif</label><input id="enquiry-{{ $key }}" name="{{ $key }}" value="{{ old($key) }}" placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}" maxlength="{{ $key === 'contact' ? 150 : 120 }}" @required($required) aria-invalid="{{ $errors->has($key) ? 'true' : 'false' }}" aria-describedby="{{ $key }}-error">@error($key)<p class="field-error" id="{{ $key }}-error">{{ $message }}</p>@enderror</div>
          @endforeach
          <div class="contact-field contact-full"><label for="enquiry-service">What do you need help with?</label><select id="enquiry-service" name="service_interest"><option value="">Select a service or product</option>@foreach (['Refrigeration','Air Conditioning','Heating & Ventilation','Maintenance','Freezing Systems','Chilled Water Systems','Products and Equipment','General Enquiry'] as $service)<option @selected(old('service_interest') === $service)>{{ $service }}</option>@endforeach</select>@error('service_interest')<p class="field-error">{{ $message }}</p>@enderror</div>
          <div class="contact-field contact-full"><label for="enquiry-message">Your message <span aria-hidden="true">*</span></label><textarea id="enquiry-message" name="message" rows="5" required maxlength="5000" placeholder="Tell us about your requirements, project location, or the support you need." aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}" aria-describedby="message-error">{{ old('message') }}</textarea>@error('message')<p class="field-error" id="message-error">{{ $message }}</p>@enderror</div>
        </div>
        <p class="contact-privacy"><i data-lucide="lock-keyhole" aria-hidden="true"></i><span>We use your details to respond to your enquiry. Read our <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.</span></p>
        <button class="btn btn-primary contact-submit" type="submit">Send enquiry <i data-lucide="arrow-up-right" aria-hidden="true"></i></button>
      </form>
    </div>
  </div></section>
</main>
