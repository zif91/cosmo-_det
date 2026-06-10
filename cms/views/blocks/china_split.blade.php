<section class="section">
  <div class="wrap split">
    <div data-reveal>
      <span class="eyebrow">{!! $b['eyebrow'] !!}</span>
      <h2 class="h-lg" style="margin-top:16px">{!! $b['heading'] !!}</h2>
      <p class="lead" style="margin-top:18px">{!! $b['lead'] !!}</p>
      @if(!empty($b['brands']))
      <div class="brands" style="margin-top:26px">
        @foreach($b['brands'] as $brand)<span class="b">{{ $brand['name'] }}</span>@endforeach
      </div>
      @endif
      @if($b['btn_text'])<div style="margin-top:30px"><a href="{{ $b['btn_link'] ?: '#zayavka' }}" class="btn btn-primary">{{ $b['btn_text'] }}</a></div>@endif
    </div>
    <div class="split-media" data-reveal data-d="1">
      @if($b['image_tag'])<span class="tag">{!! $b['image_tag'] !!}</span>@endif
      <img src="{{ $b['image'] }}" alt="{{ $b['image_alt'] ?: strip_tags($b['heading']) }}">
    </div>
  </div>
</section>
