<section class="section" id="process">
  <div class="wrap">
    <div class="section-head center" data-reveal>
      <span class="eyebrow center">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-xl">{!! $b['heading'] !!}</h2>
    </div>
    <div class="process">
      @foreach($b['steps'] ?? [] as $step)
      <div class="step" data-reveal data-d="{{ $loop->index }}"><div class="dot"><b>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</b></div><h4>{!! $step['title'] !!}</h4><p>{!! $step['text'] !!}</p></div>
      @endforeach
    </div>
  </div>
</section>
