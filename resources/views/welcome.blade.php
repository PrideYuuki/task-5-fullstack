@extends('layouts.app')

@section('content')
<div class="container-xl">
  @foreach ($articles as $item)
  <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ asset('/storage/articles/'.$item->image) }}" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $item->title }}</h5>
          <p class="card-text">{{ $item->content }}</p>
          <p class="card-text">
            <small class="text-muted">{{ $item->updated_at }}</small>
          </p>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection