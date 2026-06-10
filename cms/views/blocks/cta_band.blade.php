<section class="section-tight">
  <div class="wrap">
    <div class="cta-band" data-reveal><div class="inner">
      <div><span class="eyebrow">{!! $b['eyebrow'] !!}</span><h2 class="h-lg" style="margin-top:12px">{!! $b['heading'] !!}</h2>@if($b['text'])<p class="muted" style="margin-top:10px;max-width:46ch">{!! $b['text'] !!}</p>@endif</div>
      <div class="actions">
        @foreach($b['buttons'] ?? [] as $btn)
        <a href="{{ $btn['link'] }}" class="btn {{ ($btn['style'] ?? 'ghost') === 'primary' ? 'btn-primary' : 'btn-ghost' }}">{{ $btn['text'] }}</a>
        @endforeach
      </div>
    </div></div>
  </div>
</section>
