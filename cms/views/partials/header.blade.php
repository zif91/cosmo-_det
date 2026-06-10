@php
    $phone        = evo()->getConfig('client_phone', '+79310000000');
    $phoneDisplay = evo()->getConfig('client_phone_display', $phone);
    $ctaText      = evo()->getConfig('client_header_cta_text', 'Рассчитать');
    $ctaLink      = evo()->getConfig('client_header_cta_link', '#zayavka');
    $currentId    = (int) ($documentObject['id'] ?? 0);
@endphp
<header class="site-header">
  <div class="wrap bar">
    @include('partials.brand')
    <nav class="nav">
      @foreach($mainmenu ?? [] as $item)
        <a href="{{ $item['url'] }}"@if($currentId === (int) $item['id']) class="active" aria-current="page"@endif>{{ $item['title'] }}</a>
      @endforeach
    </nav>
    <div class="header-cta">
      <a href="tel:{{ $phone }}" class="header-phone">{{ $phoneDisplay }}</a>
      <a href="{{ $ctaLink }}" class="btn btn-primary">{{ $ctaText }}</a>
    </div>
    <button class="burger" aria-label="Меню"><span></span><span></span><span></span></button>
  </div>
</header>
<div class="mobile-menu">
  @foreach($mainmenu ?? [] as $item)
    <a href="{{ $item['url'] }}">{{ $item['longtitle'] }} <span class="muted">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></a>
  @endforeach
  <div class="mm-foot">
    <a href="tel:{{ $phone }}" class="btn btn-ghost">{{ $phoneDisplay }}</a>
    <a href="{{ $ctaLink }}" class="btn btn-primary">{{ evo()->getConfig('client_header_cta_text_long', 'Рассчитать стоимость') }}</a>
  </div>
</div>
