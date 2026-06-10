<section class="section-tight">
  <div class="wrap">
    <div class="stats" data-reveal>
      @foreach($b['items'] ?? [] as $stat)
      <div class="st">@if(is_numeric($stat['value']))<b data-count="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0</b>@else<b>{{ $stat['value'] }}{{ $stat['suffix'] }}</b>@endif<span>{{ $stat['label'] }}</span></div>
      @endforeach
    </div>
  </div>
</section>
