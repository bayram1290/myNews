@extends('layouts.main')
@section('content')
<div class="container">
  <ul class="list-group">
    @foreach ($news_list as $news)
      <li class="list-group-item border-0">
        <a href="{{route('home.news', ['id' => $news->id])}}">
          <x-news.-single-news-row>
            @slot('news_title') {{$news->name}} @endslot
            @slot('news_image') {{$news->image}} @endslot
            @slot('news_date') {{\Carbon\Carbon::parse($news->created_at)->format('d.m.Y') . ' г.'}} @endslot
          </x-news.-single-news-row>
        </a>
      </li>
    @endforeach
  </ul>
</div>
@endsection