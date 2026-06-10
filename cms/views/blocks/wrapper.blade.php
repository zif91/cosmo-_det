@foreach($data as $block)
@include('blocks.' . $block['pb']['name'], ['b' => $block])
@endforeach
