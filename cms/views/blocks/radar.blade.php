<section class="section section-tight" id="radar">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <span class="eyebrow">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-xl">{!! $b['heading'] !!}</h2>
      @if($b['text'])<p>{!! $b['text'] !!}</p>@endif
    </div>
    <div class="panel" data-reveal>
      <div class="panel-head">
        <span class="tag"><span class="dot"></span>{!! $b['panel_tag'] !!}</span>
        <div class="meta">
          <div><b>{{ $b['meta1_value'] }}</b><span>{{ $b['meta1_label'] }}</span></div>
          <div><b>{{ $b['meta2_value'] }}</b><span>{{ $b['meta2_label'] }}</span></div>
        </div>
      </div>
      <div class="radar-tabs" id="radar-tabs"></div>
      <div class="radar-grid">
        <div class="radar-stage">
          <span class="corner tl"></span><span class="corner tr"></span><span class="corner bl"></span><span class="corner br"></span>
          <div class="radar-photo">
            <img src="{{ $b['image'] }}" alt="Сканирование зон автомобиля — {{ evo()->getConfig('client_org_name', 'Космос Детейлинг') }}" loading="lazy">
            <span class="scan"></span>
            @foreach($b['hotspots'] ?? [] as $spot)
            <button class="hot" data-zone="{{ $spot['zone'] }}" style="left:{{ $spot['left'] }}%;top:{{ $spot['top'] }}%" aria-label="{{ strip_tags($spot['label']) }}"><span class="pt"></span><span class="lbl">{!! $spot['label'] !!}</span></button>
            @endforeach
          </div>
        </div>
        <div class="diag" id="radar-diag"></div>
      </div>
    </div>
  </div>
</section>
