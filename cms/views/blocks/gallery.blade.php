<section class="section section-tight"@if($b['anchor']) id="{{ $b['anchor'] }}"@endif>
  <div class="wrap">
    <div class="section-head" data-reveal><span class="eyebrow">{!! $b['eyebrow'] !!}</span><h2 class="h-xl">{!! $b['heading'] !!}</h2>@if($b['text'])<p>{!! $b['text'] !!}</p>@endif</div>
    <div class="gallery" data-reveal>
      @foreach($b['shots'] ?? [] as $shot)
      @php $thumb = $shot['thumb'] ?: $shot['image']; @endphp
      <div class="shot"><img src="{{ $thumb }}" data-full="{{ $shot['image'] }}" alt="{{ strip_tags($shot['caption']) }} — {{ evo()->getConfig('client_org_name', 'Космос Детейлинг') }}" loading="lazy"><div class="cap"><span>{{ $shot['tag'] }}</span>{!! $shot['caption'] !!}</div><span class="zoom"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="16" height="16"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4M11 8v6M8 11h6"/></svg></span></div>
      @endforeach
    </div>
    @if($b['more_text'])<div style="text-align:center;margin-top:40px" data-reveal><a href="{{ $b['more_link'] ?: '#zayavka' }}" class="btn btn-ghost btn-lg">{{ $b['more_text'] }}</a></div>@endif
  </div>
</section>
