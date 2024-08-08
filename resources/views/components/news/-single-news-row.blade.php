

<div class="card border-0 shadow">
  <div class="card-body">
    <h1 class="card-title fw-bold text-dark mb-2 text-start">{{ $news_title }}</h1>
    <img class="d-block img-fluid object-contain w-25 mx-auto" src="{{asset( 'storage/' .  $news_image)}}">
    <p class="text-end card-text text-muted">{{$news_date}}</p>    
</div>