<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $page->title }} | Thermo-Care</title>
  <meta name="description" content="{{ $page->meta_description }}">
  <link rel="icon" href="/assets/logo/favicon.png"><script src="https://cdn.tailwindcss.com"></script><link rel="stylesheet" href="/assets/css/site.css">
</head>
<body class="bg-slate-50 text-slate-800">
  <header class="site-header"><div class="container-page flex h-20 items-center justify-between gap-8"><a href="/"><img src="/assets/logo/thermocare-logo-mark.png" class="brand-logo" alt="Thermo-Care"></a><nav class="desktop-nav flex items-center gap-7" aria-label="Main navigation"></nav></div></header>
  <main><section class="inner-hero py-20 text-white"><div class="container-page"><p class="text-cyan-200">Thermo-Care Engineering</p><h1 class="mt-4 text-5xl font-black">{{ $page->title }}</h1></div></section><article class="container-page section-pad prose prose-slate max-w-4xl">{!! $page->content !!}</article></main>
  <script src="/assets/js/site.js"></script>
</body></html>
