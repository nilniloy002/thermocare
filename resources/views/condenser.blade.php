<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Condensers | Thermo-Care</title><script src="https://cdn.tailwindcss.com"></script><script src="https://unpkg.com/lucide@latest"></script><link rel="stylesheet" href="assets/css/site.css"></head><body>  <header class="site-header">
    <div class="container-page flex h-20 items-center justify-between gap-8">
      <a href="index.html" aria-label="Thermo-Care home"><img src="{{ $brandDarkUrl }}" width="758" height="209" class="brand-logo" alt="Thermo-Care Engineering Limited"></a>
      <nav class="desktop-nav flex items-center gap-7" aria-label="Main navigation">
        <a class="nav-link" href="index.html" aria-current="page">Home</a>
        <a class="nav-link" href="about.html">About Us</a>
        <div class="relative" data-dropdown-root>
          <button class="nav-link focus-ring inline-flex items-center gap-1" data-dropdown-trigger aria-expanded="false" aria-controls="servicesMenu">Services <i data-lucide="chevron-down" class="h-4 w-4"></i></button>
          <div class="dropdown-panel" id="servicesMenu" data-open="false">
            <div class="grid gap-6 lg:grid-cols-4">
              <div>
                <h3 class="mb-3 font-black">Core Engineering</h3>
                <a class="mega-link" href="services.html"><span class="mega-icon"><i data-lucide="snowflake" class="h-4 w-4"></i></span><span><b>Refrigeration</b><small class="block">Cold rooms, freezers and process cooling</small></span></a>
                <a class="mega-link" href="services.html"><span class="mega-icon"><i data-lucide="fan" class="h-4 w-4"></i></span><span><b>Air Conditioning</b><small class="block">Commercial, VRF and industrial AC</small></span></a>
              </div>
              <div>
                <h3 class="mb-3 font-black">Building Systems</h3>
                <a class="mega-link" href="services.html"><span class="mega-icon"><i data-lucide="flame" class="h-4 w-4"></i></span><span><b>Heating</b><small class="block">Application-led heating support</small></span></a>
                <a class="mega-link" href="services.html"><span class="mega-icon"><i data-lucide="wind" class="h-4 w-4"></i></span><span><b>Ventilation</b><small class="block">Supply, exhaust and air movement</small></span></a>
              </div>
              <div>
                <h3 class="mb-3 font-black">Support</h3>
                <a class="mega-link" href="services.html"><span class="mega-icon"><i data-lucide="settings" class="h-4 w-4"></i></span><span><b>RHVAC Components</b><small class="block">Valves, controls, pipes and spare parts</small></span></a>
                <a class="mega-link" href="services.html"><span class="mega-icon"><i data-lucide="wrench" class="h-4 w-4"></i></span><span><b>Maintenance</b><small class="block">After-sales service and inspection</small></span></a>
              </div>
              <div class="rounded-lg bg-sky-50 p-5">
                <h3 class="font-black">Need a system plan?</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Share your project requirements and get the right solution path before equipment selection.</p>
                <a class="btn btn-primary mt-5 w-full" href="contact.html">Discuss Your Project</a>
                <a class="mt-4 block text-center text-sm font-black text-sky-700" href="services.html">View All Services</a>
              </div>
            </div>
          </div>
        </div>
        <div class="relative" data-dropdown-root>
          <button class="nav-link focus-ring inline-flex items-center gap-1" data-dropdown-trigger aria-expanded="false" aria-controls="productsMenu">Products <i data-lucide="chevron-down" class="h-4 w-4"></i></button>
          <div class="dropdown-panel" id="productsMenu" data-open="false">
            <div class="grid gap-6 lg:grid-cols-4">
              <div><h3 class="mb-3 font-black">Refrigeration Equipment</h3><a class="mega-link" href="compressor.html"><span class="mega-icon"><i data-lucide="settings-2" class="h-4 w-4"></i></span><span><b>Compressors</b><small class="block">Reliable cooling capacity for demanding systems</small></span></a><a class="mega-link" href="condenser.html"><span class="mega-icon"><i data-lucide="fan" class="h-4 w-4"></i></span><span><b>Condensers</b><small class="block">Efficient heat rejection services</small></span></a><a class="mega-link" href="evaporator.html"><span class="mega-icon"><i data-lucide="snowflake" class="h-4 w-4"></i></span><span><b>Evaporators</b><small class="block">Unit coolers for cold rooms and process cooling</small></span></a></div>
              <div><h3 class="mb-3 font-black">Freezing & Cooling</h3><a class="mega-link" href="freezing-systems.html"><span class="mega-icon"><i data-lucide="snowflake" class="h-4 w-4"></i></span><span><b>Freezing Systems</b><small class="block">Plate and spiral freezer equipment</small></span></a><a class="mega-link" href="chilled-water-systems.html"><span class="mega-icon"><i data-lucide="droplets" class="h-4 w-4"></i></span><span><b>Chilled Water Systems</b><small class="block">Central process cooling and water systems</small></span></a></div>
              <div><h3 class="mb-3 font-black">Insulation Systems</h3><a class="mega-link" href="sandwich-panels.html"><span class="mega-icon"><i data-lucide="layers-3" class="h-4 w-4"></i></span><span><b>Sandwich Panels</b><small class="block">PU, EPS, rock wool and glass wool options</small></span></a><a class="mega-link" href="products.html"><span class="mega-icon"><i data-lucide="panel-top" class="h-4 w-4"></i></span><span><b>Cold Room Panels</b><small class="block">Insulated enclosure systems</small></span></a></div>
              <div><h3 class="mb-3 font-black">Components & Brands</h3><a class="mega-link" href="products.html"><span class="mega-icon"><i data-lucide="sliders-horizontal" class="h-4 w-4"></i></span><span><b>RHVAC Components</b><small class="block">Controls, valves and line components</small></span></a><a class="mega-link" href="products.html"><span class="mega-icon"><i data-lucide="package" class="h-4 w-4"></i></span><span><b>Spare Parts</b><small class="block">Application-ready replacement parts</small></span></a></div>
            </div>
          </div>
        </div>
        <a class="nav-link" href="projects.html">Projects</a>
        <a class="nav-link" href="insights.html">Insights</a>
        <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
      </nav>
      <div class="flex items-center gap-3">
        <button id="menuButton" class="mobile-menu-button focus-ring h-11 w-11 rounded border border-slate-200" aria-label="Open menu" aria-expanded="false"><i data-lucide="menu" class="mx-auto"></i></button>
      </div>
    </div>
  </header>

  <div id="drawerBackdrop" class="drawer-backdrop" data-open="false"></div>
  <aside id="mobileDrawer" class="mobile-drawer" data-open="false" aria-hidden="true" aria-label="Mobile navigation">
    <div class="flex items-center justify-between border-b p-5"><img src="{{ $brandDarkUrl }}" class="brand-logo" alt="Thermo-Care Engineering Limited"><button id="drawerClose" class="h-11 w-11 rounded border" aria-label="Close menu"><i data-lucide="x" class="mx-auto"></i></button></div>
    <div class="space-y-2 p-5">
      <a class="block py-3 font-bold" href="index.html">Home</a><a class="block py-3 font-bold" href="about.html">About Us</a>
      <button data-accordion aria-expanded="false" aria-controls="mServices" class="flex w-full items-center justify-between py-3 font-bold">Services <i data-lucide="chevron-down"></i></button>
      <div id="mServices" hidden class="pl-4 text-slate-600"><a class="block py-2" href="services.html">Refrigeration</a><a class="block py-2" href="services.html">Air Conditioning</a><a class="block py-2" href="services.html">Maintenance</a></div>
      <button data-accordion aria-expanded="false" aria-controls="mProducts" class="flex w-full items-center justify-between py-3 font-bold">Products <i data-lucide="chevron-down"></i></button>
      <div id="mProducts" hidden class="pl-4 text-slate-600"><a class="block py-2" href="compressor.html">Compressors</a><a class="block py-2" href="condenser.html">Condensers</a><a class="block py-2" href="evaporator.html">Evaporators</a><a class="block py-2" href="products.html">Line Components</a></div>
      <a class="block py-3 font-bold" href="projects.html">Projects</a><a class="block py-3 font-bold" href="insights.html">Insights</a><a class="block py-3 font-bold" href="{{ route('contact') }}">Contact Us</a>
      <a class="btn btn-primary mt-4 w-full" href="contact.html">Request a Quote</a>
    </div>
  </aside>

  <div id="searchOverlay" class="fixed inset-0 z-90 hidden bg-white/95 p-6 backdrop-blur">
    <div class="container-page pt-8"><button id="searchClose" class="float-right h-11 w-11 rounded border" aria-label="Close search"><i data-lucide="x" class="mx-auto"></i></button><label class="mb-3 block font-black" for="siteSearchInput">Search products, brands or services</label><input id="siteSearchInput" class="w-full rounded border border-slate-300 p-4 text-xl" placeholder="Search products, brands or services"><div class="mt-8 grid gap-4 md:grid-cols-3"><a class="card p-5" href="products.html">Compressors and condensers</a><a class="card p-5" href="services.html">Cold storage services</a><a class="card p-5" href="contact.html">Talk to engineering team</a></div></div>
  </div>
  <main id="main" class="condenser-page">
    <section class="condenser-hero"><div class="container-page condenser-hero-grid"><div class="condenser-hero-copy"><nav class="compressor-breadcrumb" aria-label="Breadcrumb"><a href="index.html">Home</a><span>/</span><a href="products.html">Products</a><span>/</span><span aria-current="page">Condensers</span></nav><span class="eyebrow">Refrigeration Equipment</span><h1>Heat rejection designed around your operating conditions.</h1><p>Explore air-cooled, water-cooled and evaporative condenser systems for refrigeration, cold storage, commercial cooling and demanding industrial applications.</p><div class="compressor-hero-actions"><a class="btn btn-primary" href="contact.html">Request a Quote <i data-lucide="arrow-up-right" class="h-4 w-4"></i></a><a class="btn btn-secondary" href="#condenser-ranges">Explore Condenser Types</a></div><div class="compressor-quickfacts"><span><i data-lucide="wind"></i>Air, water & evaporative</span><span><i data-lucide="thermometer-sun"></i>High heat-transfer capacity</span><span><i data-lucide="settings-2"></i>Application-led selection</span></div></div><div class="condenser-hero-image"><img src="assets/images/condensers/xmk-rc-air-cooled.jpg" alt="XMK RC series air-cooled condenser"><div><span>Featured range</span><b>XMK RC series air-cooled condensers</b></div></div></div></section>
    <section class="compressor-intro section-pad"><div class="container-page compressor-intro-grid"><div><span class="eyebrow">The Right Heat-Rejection Strategy</span><h2>Three condenser technologies. One complete system view.</h2></div><p>Condenser choice must balance cooling duty, ambient conditions, water availability, space, refrigerant and maintenance requirements. Thermo-Care helps define a practical route before equipment is selected.</p></div></section>
    <section id="condenser-ranges" class="condenser-ranges section-pad"><div class="container-page"><div class="compressor-section-heading"><div><span class="eyebrow">Condenser Types</span><h2>Choose the cooling method that fits your site.</h2></div><p>Each option supports a different combination of capacity, installation environment and operating priorities.</p></div><div class="condenser-card-grid"><article class="condenser-card"><div class="condenser-card-image"><img src="assets/images/condensers/xmk-hc-air-cooled.jpg" alt="XMK HC air-cooled condenser"></div><div class="condenser-card-copy"><span>AIR-COOLED</span><h3>XMK HC & RC series</h3><p>Air-cooled condensers for cold rooms and remote condensing units, designed with copper tubes and corrugated aluminium fins for reliable heat transfer.</p><ul><li>HC for open, scroll, hermetic and semi-hermetic systems</li><li>RC for larger remote units, parallel piston and screw systems</li></ul></div></article><article class="condenser-card"><div class="condenser-card-image"><img src="assets/images/condensers/bitzer-water-cooled.png" alt="BITZER water-cooled shell and tube condenser"></div><div class="condenser-card-copy"><span>WATER-COOLED</span><h3>BITZER shell & tube condensers</h3><p>Standard and seawater-resistant shell-and-tube condenser designs with high-performance tubes and serviceable coolant reversing covers.</p><ul><li>K series for common refrigerants and coolants</li><li>Standard capacities extend above 1000 kW</li></ul></div></article><article class="condenser-card"><div class="condenser-card-image"><img src="assets/images/condensers/sft-evaporative.png" alt="SFT evaporative condenser"></div><div class="condenser-card-copy"><span>EVAPORATIVE</span><h3>SFT & OceanBlue evaporative units</h3><p>Evaporative condenser options for refrigeration systems requiring efficient heat rejection through an integrated coil, water circulation and airflow design.</p><ul><li>Stainless-steel construction options</li><li>Suitable for cold storage, ice and industrial refrigeration</li></ul></div></article></div></div></section>
    <section class="condenser-selection"><div class="container-page condenser-selection-grid"><div class="condenser-selection-visual"><img src="assets/images/condensers/oceanblue-evaporative.png" alt="OceanBlue ECE evaporative condenser"><div><i data-lucide="waves"></i><span>System choice shaped by heat load and site conditions</span></div></div><div class="compressor-selection-copy"><span class="eyebrow">Engineering-Led Selection</span><h2>Match condenser performance to the complete refrigeration system.</h2><p>Our team considers your heat load, refrigerant, ambient temperature, available utilities, water quality, installation space and maintenance plan before advising on an air-cooled, water-cooled or evaporative solution.</p><div class="selection-list"><div><i data-lucide="gauge"></i><span>Required capacity and heat rejection duty</span></div><div><i data-lucide="cloud-sun"></i><span>Ambient conditions and available utilities</span></div><div><i data-lucide="droplets"></i><span>Water quality and corrosion considerations</span></div></div><a class="text-link-dark" href="contact.html">Speak with an engineer <i data-lucide="arrow-up-right"></i></a></div></div></section>
    <section class="compressor-cta"><div class="container-page compressor-cta-inner"><div><span class="eyebrow">Plan Your System</span><h2>Need a condenser that performs reliably in your environment?</h2><p>Share your application and our team will help you choose the right cooling approach.</p></div><a class="btn btn-primary" href="contact.html">Talk to Thermo-Care <i data-lucide="arrow-up-right" class="h-4 w-4"></i></a></div></section>
  </main>

@include('partials.footer')
  <script src="assets/js/site.js"></script><script>lucide.createIcons();</script></body></html>
