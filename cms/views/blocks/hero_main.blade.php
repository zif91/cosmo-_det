@php $wa = evo()->getConfig('client_whatsapp', '#'); @endphp
<section class="hero">
  <div class="hero-media"><img src="{{ $b['image'] }}" alt="{{ $b['image_alt'] ?: strip_tags($b['heading']) }}" fetchpriority="high"></div>
  <div class="wrap hero-inner">
    <span class="eyebrow" data-reveal>{!! $b['eyebrow'] !!}</span>
    <h1 class="h-xxl" data-reveal data-d="1">{!! $b['heading'] !!}</h1>
    <p class="lead" data-reveal data-d="2">{!! $b['lead'] !!}</p>
    <div class="hero-cta" data-reveal data-d="3">
      @if($b['btn1_text'])<a href="{{ $b['btn1_link'] ?: '#calculator' }}" class="btn btn-primary btn-lg">{{ $b['btn1_text'] }} @include('partials.icon-arrow')</a>@endif
      @if($b['btn2_text'])<a href="{{ $b['btn2_link'] ?: $wa }}" class="btn btn-wa btn-lg" target="_blank" rel="noopener">@include('partials.icon-wa') {{ $b['btn2_text'] }}</a>@endif
    </div>
    @if(!empty($b['counters']))
    <div class="hero-meta" data-reveal data-d="4">
      @foreach($b['counters'] as $counter)
      <div class="m">@if(is_numeric($counter['value']))<b data-count="{{ $counter['value'] }}" data-suffix="{{ $counter['suffix'] }}">0</b>@else<b>{{ $counter['value'] }}{{ $counter['suffix'] }}</b>@endif<span>{{ $counter['label'] }}</span></div>
      @endforeach
    </div>
    @endif
  </div>
</section>
