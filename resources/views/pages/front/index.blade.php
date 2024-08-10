@extends('layouts.main')
@section('content')
<div class="container">
  @if (count($news_list) > 0)
    @include('pages.front.load_news')
  @else
    <p class="text-danger">Пока нет никаких опубликованных новостей</p>
  @endif
</div>
@endsection

@section('js')
<script type="text/javascript">
  var next_page, prev_page
  function getAPIData(pageData){    
    $.ajax({
      url:  pageData,
      type: "get",
      datatype: "json",
    })
    .done(function(data){
      $('.pagination li:first').removeClass('disabled').empty()
      $('.pagination li:last').removeClass('disabled').empty()

      prev_page = data['news_list']['prev_page_url']
      next_page = data['news_list']['next_page_url']
      prev_page == null ? $('.pagination li:first').addClass('disabled').html('<span class="page-link" aria-hidden="true">‹</span>'):$('.pagination li:first').html( '<a class="page-link" href="' +  prev_page.replace('/api', '') + '" rel="prev" aria-label="« Previous">‹</a>')
      next_page == null ? $('.pagination li:last').addClass('disabled').html('<span class="page-link" aria-hidden="true">›</span>'):$('.pagination li:last').html( '<a class="page-link" href="' +  next_page.replace('/api', '')  + '" rel="next" aria-label="« Next">›</a>')

      var news_list = data['news_list']['data'], content='', news_element, base_url = window.location.origin, news_date      
      news_list.forEach(news => {
        news_date = new Date(news.created_at)
        news_element = '<li class="list-group-item border-0"> <a href="'+ base_url + '/news/' + news.id  +'"> <div class="card border-0 shadow"> <div class="card-body"> <h1 class="card-title fw-bold text-dark mb-2 text-start">' + news.name + '</h1> <img class="d-block img-fluid object-contain w-25 mx-auto" src="' + base_url + '/storage/' + news.image + '"> <p class="text-end card-text text-muted">' + ("0" + news_date.getDate()).slice(-2) + '.' +  ("0" + (news_date.getMonth() + 1)).slice(-2)  + '.' + news_date.getFullYear() + ' г.</p> </div> </div> </a> </li>'
        content += news_element
      })
      $("#flist_news").empty().html(content)
    })
    .fail(function(jqXHR, ajaxOptions, thrownError){ alert('Нет ответа от сервера')  })
  }

  $(function () {
    $(document).on('click', '.pagination a', function(event)  {
      event.preventDefault()
      $('li').removeClass('active')
      if( $(this).parent('li').prev().length && $(this).parent('li').next().length ) $(this).parent('li').addClass('active')
      else $(this).parents('.pagination').find('li:nth(' + ( Number( $(this).attr('href').substring(Number($(this).attr('href').indexOf('page=') + 5))))  + ')').addClass('active')
    
      var url = $(this).attr('href')
      window.history.pushState("", "", url)
      getAPIData(url.replace('?', '/api/?'))
    })
  });
</script>
@endsection