<section class="section section-tight" id="otzyvy">
  <div class="wrap">
    <div class="section-head center" data-reveal>
      <span class="eyebrow center">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-xl">{!! $b['heading'] !!}</h2>
      @if($b['text'])<p>{!! $b['text'] !!}</p>@endif
    </div>
    <div class="reviews">
      @foreach($b['items'] ?? [] as $review)
      <div class="review" data-reveal data-d="{{ $loop->index % 3 }}"><div class="stars">{{ str_repeat('★', (int) ($review['stars'] ?: 5)) }}</div><p>{!! $review['text'] !!}</p><div class="who"><span class="av">{{ mb_substr($review['name'], 0, 1) }}</span><div><b>{{ $review['name'] }}</b><span>{{ $review['car'] }}</span></div></div></div>
      @endforeach
    </div>
  </div>
</section>
