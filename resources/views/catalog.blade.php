<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products | Thermo-Care</title><link rel="icon" href="/assets/logo/favicon.png">
  <script src="https://cdn.tailwindcss.com"></script><link rel="stylesheet" href="/assets/css/site.css">
</head>
<body class="bg-slate-50 text-slate-800">
  <header class="site-header"><div class="container-page flex h-20 items-center justify-between gap-8"><a href="/"><img src="{{ $brandDarkUrl }}" class="brand-logo" alt="Thermo-Care"></a><nav class="desktop-nav flex items-center gap-7" aria-label="Main navigation"></nav></div></header>
  <main><section class="inner-hero py-20 text-white"><div class="container-page"><p class="text-cyan-200">Equipment catalogue</p><h1 class="mt-4 text-5xl font-black">Products</h1><p class="mt-4 max-w-2xl text-lg">Industrial refrigeration, HVAC and cooling equipment selected for dependable operation.</p></div></section>
  <section class="section-pad"><div class="container-page"><div class="mb-10 flex flex-col justify-between gap-4 md:flex-row md:items-end"><div><span class="eyebrow">Available equipment</span><h2 class="mt-3 text-3xl font-black">Find the right system component.</h2></div><a class="btn btn-primary" href="/contact.html">Request a Quote</a></div>
  @if($products->isEmpty())<div class="rounded-lg border border-dashed border-slate-300 bg-white p-10 text-center"><h2 class="text-xl font-black">Products are being added</h2><p class="mt-2 text-slate-600">Please contact our engineering team for current availability.</p></div>@else<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">@foreach($products as $product)<article class="card overflow-hidden"><img src="{{ $product->image ? asset($product->image) : asset('assets/images/compressor.png') }}" class="aspect-[4/3] w-full object-cover" alt="{{ $product->name }}"><div class="p-5"><p class="text-sm font-bold text-sky-700">{{ $product->family }} {{ $product->brand ? '· '.$product->brand : '' }}</p><h2 class="mt-2 text-xl font-black">{{ $product->name }}</h2><p class="mt-3 text-slate-600">{{ $product->summary }}</p><a class="mt-5 inline-block font-black text-sky-700" href="/contact.html">Discuss this product →</a></div></article>@endforeach</div>@endif</div></section></main>
  <script src="/assets/js/site.js"></script>
</body></html>
