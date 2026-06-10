<section class="section section-tight">
  <div class="wrap">
    <div class="section-head" data-reveal><span class="eyebrow">{!! $b['eyebrow'] !!}</span><h2 class="h-xl">{!! $b['heading'] !!}</h2>@if($b['text'])<p>{!! $b['text'] !!}</p>@endif</div>
    <div class="price-table" data-reveal>
      @foreach($b['rows'] ?? [] as $row)
      <div class="pt-row"><div class="nm"><b>{!! $row['name'] !!}</b><span>{!! $row['descr'] !!}</span></div><div class="pr">{{ $row['price'] }}</div></div>
      @endforeach
    </div>
    @if($b['note'])<p class="form-note" style="margin-top:18px">{!! $b['note'] !!}</p>@endif
  </div>
</section>
