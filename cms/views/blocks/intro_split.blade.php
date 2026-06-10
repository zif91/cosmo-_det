<section class="section">
  <div class="wrap split">
    <div data-reveal>
      @if($b['tag'])<span class="eyebrow">{!! $b['tag'] !!}</span>@endif
      <h2 class="h-lg" style="margin-top:16px">{!! $b['heading'] !!}</h2>
      <p class="lead" style="margin-top:18px">{!! $b['text'] !!}</p>
      @if(!empty($b['checks']))
      <ul class="check-list">
        @foreach($b['checks'] as $check)
        <li>@include('partials.icon-check')<span>{!! $check['text'] !!}</span></li>
        @endforeach
      </ul>
      @endif
    </div>
    <div class="split-media" data-reveal data-d="1">@if($b['image_tag'])<span class="tag">{!! $b['image_tag'] !!}</span>@endif<img src="{{ $b['image'] }}" alt="{{ strip_tags($b['heading']) }}"></div>
  </div>
</section>
