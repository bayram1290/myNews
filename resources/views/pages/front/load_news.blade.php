<ul class="list-group mb-3" id="flist_news">
  @foreach ($news_list as $news)
    <li class="list-group-item border-0">
      <a href="{{route('home.news', ['id' => $news->id])}}">
        <x-news.-single-news-row>
          @slot('news_title') {{ ucwords($news->name)}} @endslot
          @slot('news_image') {{$news->image}} @endslot
          @slot('news_date') {{\Carbon\Carbon::parse($news->created_at)->format('d.m.Y') . ' г.'}} @endslot
        </x-news.-single-news-row>
      </a>
    </li>
  @endforeach
</ul>
<div class="d-flex justify-content-center">
  {!! $news_list->links('pagination::bootstrap-4') !!}
</div>