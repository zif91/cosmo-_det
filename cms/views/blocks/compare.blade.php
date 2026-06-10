<section class="section" id="o-studii">
  <div class="wrap">
    <div class="section-head center" data-reveal>
      <span class="eyebrow center">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-xl">{!! $b['heading'] !!}</h2>
      @if($b['text'])<p>{!! $b['text'] !!}</p>@endif
    </div>
    <div class="compare">
      <div class="col bad" data-reveal>
        <span>{{ $b['bad_label'] }}</span>
        <h3>{!! $b['bad_title'] !!}</h3>
        <ul>
          @foreach($b['bad_items'] ?? [] as $item)
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 6l12 12M18 6L6 18"/></svg>{!! $item['text'] !!}</li>
          @endforeach
        </ul>
      </div>
      <div class="col good" data-reveal data-d="1">
        <span>{{ $b['good_label'] }}</span>
        <h3>{!! $b['good_title'] !!}</h3>
        <ul>
          @foreach($b['good_items'] ?? [] as $item)
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 6L9 17l-5-5"/></svg>{!! $item['text'] !!}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
