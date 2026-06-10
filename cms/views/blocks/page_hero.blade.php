@php
    $wa = evo()->getConfig('client_whatsapp', '#');
    $b1link = $b['btn1_link'] ?: '#zayavka';
    $b2link = $b['btn2_link'] ?: $wa;
@endphp
<section class="page-hero">
  <div class="ph-media"><img src="{{ $b['image'] }}" alt="{{ strip_tags($b['heading']) }}"></div>
  <div class="wrap">
    <nav class="breadcrumbs" data-reveal><a href="{{ UrlProcessor::makeUrl(evo()->getConfig('site_start')) }}">Главная</a><span class="sep">/</span><span>{{ $documentObject['pagetitle'] }}</span></nav>
    @if($b['eyebrow'])<span class="eyebrow" data-reveal>{!! $b['eyebrow'] !!}</span>@endif
    <h1 class="h-xl" data-reveal data-d="1" style="margin-top:18px">{!! $b['heading'] !!}</h1>
    <p class="lead" data-reveal data-d="2">{!! $b['lead'] !!}</p>
    @if($b['btn1_text'] || $b['btn2_text'])
    <div class="hero-cta" data-reveal data-d="3">
      @if($b['btn1_text'])<a href="{{ $b1link }}" class="btn btn-primary btn-lg">{{ $b['btn1_text'] }} @include('partials.icon-arrow')</a>@endif
      @if($b['btn2_text'])<a href="{{ $b2link }}" class="btn btn-ghost btn-lg"@if(str_starts_with($b2link, 'http')) target="_blank" rel="noopener"@endif>{{ $b['btn2_text'] }}</a>@endif
    </div>
    @endif
  </div>
</section>
