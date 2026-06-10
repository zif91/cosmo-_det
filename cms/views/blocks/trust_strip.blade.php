<section class="trust">
  <div class="wrap"><div class="row">
    @foreach($b['items'] ?? [] as $item)
    <div class="cell">{!! $item['icon'] !!}<div><b>{!! $item['title'] !!}</b><p>{!! $item['text'] !!}</p></div></div>
    @endforeach
  </div></div>
</section>
