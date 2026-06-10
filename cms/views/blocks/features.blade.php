<section class="section section-tight">
  <div class="wrap">
    <div class="section-head center" data-reveal><span class="eyebrow center">{!! $b['eyebrow'] !!}</span><h2 class="h-xl">{!! $b['heading'] !!}</h2></div>
    <div class="grid grid-4">
      @foreach($b['items'] ?? [] as $item)
      <div class="feat" data-reveal><div class="ic">{!! $item['icon'] !!}</div><h3>{!! $item['title'] !!}</h3><p>{!! $item['text'] !!}</p></div>
      @endforeach
    </div>
  </div>
</section>
