@php
    $cfg = fn ($key, $default = '') => evo()->getConfig($key, $default);
@endphp
<section class="section section-tight">
  <div class="wrap">
    <div class="split">
      <div data-reveal>
        <div class="foot-contacts" style="display:grid;gap:6px">
          <div class="c" style="margin-bottom:22px"><span>Адрес</span><b style="font-size:1.3rem">{{ $cfg('client_address_full') }}</b></div>
          <div class="c" style="margin-bottom:22px"><span>Телефон</span><b style="font-size:1.3rem"><a href="tel:{{ $cfg('client_phone') }}">{{ $cfg('client_phone_display') }}</a></b></div>
          <div class="c" style="margin-bottom:22px"><span>Почта</span><b style="font-size:1.15rem"><a href="mailto:{{ $cfg('client_email') }}">{{ $cfg('client_email') }}</a></b></div>
          <div class="c" style="margin-bottom:22px"><span>Режим работы</span><b style="font-size:1.15rem">{{ $cfg('client_worktime_full', $cfg('client_worktime')) }}</b></div>
        </div>
        <div class="hero-cta" style="margin-top:8px">
          @if($cfg('client_whatsapp'))<a href="{{ $cfg('client_whatsapp') }}" class="btn btn-wa" target="_blank" rel="noopener">@include('partials.icon-wa')WhatsApp</a>@endif
          @if($cfg('client_telegram'))<a href="{{ $cfg('client_telegram') }}" class="btn btn-ghost" target="_blank" rel="noopener">@include('partials.icon-tg')Telegram</a>@endif
        </div>
        @if(!empty($b['checks']))
        <ul class="check-list" style="margin-top:34px">
          @foreach($b['checks'] as $check)
          <li>@include('partials.icon-check')<span>{!! $check['text'] !!}</span></li>
          @endforeach
        </ul>
        @endif
      </div>
      <div class="split-media" data-reveal data-d="1" style="aspect-ratio:auto">
        <iframe title="{{ $cfg('client_org_name') }} на карте" src="{{ $b['map_embed'] ?: $cfg('client_map_embed') }}" width="100%" height="460" frameborder="0" allowfullscreen style="border:0;display:block;min-height:460px"></iframe>
      </div>
    </div>
  </div>
</section>
