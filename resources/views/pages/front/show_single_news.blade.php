@extends('layouts.main')

@section('content')
  <div class="mt-5 justify-content-center">
    <div class="card border-0">
      <img src="{{asset( 'storage/' . $news_data->image)}}" class="card-img-top w-50 d-block mx-auto " alt="News image">
      <div class="card-body">
        <h1 class="card-title font-weight-bold mb-1">{{$news_data->name}}</h1>
        <h4 class="card-subtitle mb-2 text-muted">Автор: {{$news_data->author}}</h4>
        <p class="card-text">{{$news_data->description}}</p>
        <hr class="hr mt-5" />
        <p class="text-end mt-2">{{\Carbon\Carbon::parse($news_data->created_at)->format('d.m.Y') . ' г.'}}</p>
      </div>
    </div>
  </div>
@endsection