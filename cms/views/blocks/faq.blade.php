<section class="section"@if($b['anchor']) id="{{ $b['anchor'] }}"@endif>
  <div class="wrap">
    <div class="section-head center" data-reveal><span class="eyebrow center">{!! $b['eyebrow'] !!}</span><h2 class="h-xl">{!! $b['heading'] !!}</h2></div>
    <div class="faq" data-reveal>
      @foreach($b['items'] ?? [] as $item)
      <div class="qa"><button>{!! $item['question'] !!}<span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M12 5v14M5 12h14"/></svg></span></button><div class="ans"><p>{!! $item['answer'] !!}</p></div></div>
      @endforeach
    </div>
  </div>
</section>
