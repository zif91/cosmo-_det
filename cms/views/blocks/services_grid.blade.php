<section class="section section-tight" id="uslugi">
  <div class="wrap">
    <div class="section-head" data-reveal>
      <span class="eyebrow">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-xl">{!! $b['heading'] !!}</h2>
      @if($b['text'])<p>{!! $b['text'] !!}</p>@endif
    </div>
    <div class="grid grid-3">
      @foreach($b['cards'] ?? [] as $card)
      @php
        $link = $card['doc_id'] ? UrlProcessor::makeUrl((int) $card['doc_id']) . ($card['anchor'] ?? '') : ($card['link'] ?? '#');
      @endphp
      <a href="{{ $link }}" class="card svc" data-reveal data-d="{{ $loop->index % 3 }}">
        <div class="ph"><span class="num">{{ $card['num'] }}</span><img src="{{ $card['image'] }}" alt="{{ $card['image_alt'] ?: strip_tags($card['title']) }}"></div>
        <div class="body">
          <h3>{!! $card['title'] !!}</h3>
          <p>{!! $card['text'] !!}</p>
          <div class="tags">@foreach(array_filter(array_map('trim', explode(',', $card['tags'] ?? ''))) as $tag)<span>{{ $tag }}</span>@endforeach</div>
          <span class="more">Подробнее @include('partials.icon-arrow')</span>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
