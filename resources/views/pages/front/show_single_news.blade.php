@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="mt-5 justify-content-center">
      <div class="card border-0">
        <img src="{{asset( 'storage/' . $news_data->image)}}" class="card-img-top w-50 d-block mx-auto " alt="News image">
        <div class="card-body">
          <h1 class="card-title font-weight-bold mb-1">{{$news_data->name}}</h1>
          <article class="card-subtitle mb-2 text-muted d-flex flex-row justify-content-between">

            <h4>Автор: {{$news_data->author}}</h4>
            <span>Просмотр: {{$news_view}}</span>

          </article>
          <p class="card-text">{{$news_data->description}}</p>
          <hr class="hr mt-5" />
          <p class="text-end mt-2">{{\Carbon\Carbon::parse($news_data->created_at)->format('d.m.Y') . ' г.'}}</p>
        </div>
      </div>
    </div>
  </div>
@endsection