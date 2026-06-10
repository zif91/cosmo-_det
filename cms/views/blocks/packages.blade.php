<section class="section" id="pakety">
  <div class="wrap">
    <div class="section-head center" data-reveal>
      <span class="eyebrow center">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-xl">{!! $b['heading'] !!}</h2>
      @if($b['text'])<p>{!! $b['text'] !!}</p>@endif
    </div>
    <div class="grid grid-3">
      @foreach($b['items'] ?? [] as $pkg)
      <div class="pkg{{ !empty($pkg['featured']) ? ' featured' : '' }}" data-reveal data-d="{{ $loop->index % 3 }}">
        @if(!empty($pkg['badge']))<span class="badge">{{ $pkg['badge'] }}</span>@endif
        <div class="pkg-name">{{ $pkg['name'] }}</div>
        <div class="pkg-for">{!! $pkg['for'] !!}</div>
        <div class="pkg-price"><span class="from">от</span><b>{{ $pkg['price'] }}</b><span class="from">₽</span></div>
        <ul>
          @foreach(preg_split('~\R~u', trim($pkg['features'] ?? '')) as $feature)
          @if(trim($feature) !== '')<li>@include('partials.icon-check'){!! trim($feature) !!}</li>@endif
          @endforeach
        </ul>
        <a href="{{ $pkg['btn_link'] ?: '#zayavka' }}" class="btn {{ !empty($pkg['featured']) ? 'btn-primary' : 'btn-ghost' }} btn-block">{{ $pkg['btn_text'] ?: 'Выбрать ' . $pkg['name'] }}</a>
      </div>
      @endforeach
    </div>
    @if($b['note'])<p class="form-note" style="text-align:center;margin-top:22px">{!! $b['note'] !!}</p>@endif
  </div>
</section>
