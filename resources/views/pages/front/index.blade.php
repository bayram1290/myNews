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
  var next_page, prev_page, news_links, pagination = $('.pagination').children('li'), iter, arr_limit, page_url, news_list, content='', news_element, base_url = window.location.origin, news_date

  function create_nav(index, limit, link) {    
    switch (index) {
      case 0:
        return link['url']==null ? '<span class="page-link" aria-hidden="true">‹</span>': '<a class="page-link" href="'+ get_url(link['url']) +'" rel="prev" aria-label="« Previous">‹</a>'
      case limit:     
        return link['url']==null ? '<span class="page-link" aria-hidden="true">&raquo;</span>': '<a class="page-link" href="'+ get_url(link['url']) +'" rel="next" aria-label="Next »">›</a>'
      default:
        return link['active'] ? '<span class="page-link">'+link['label']+'</span>': '<a class="page-link" href="'+get_url(link['url'])+'">'+link['label']+'</a>'
    }
  }


  function get_url(url) {  return url.replace('/api', '') }

  function getAPIData(pageData){
    console.log(pageData)
    
    $.ajax({
      url:  pageData,
      type: "get",
      datatype: "json",
    })
    .done(function(data){
      news_links = data['news_list']['links'], iter=0, arr_limit = (news_links.length - 1)
      pagination.removeClass('disabled active')

      news_links.forEach(link => {      
        switch (iter) {
          case 0:
          case arr_limit:
            if(link['url']==null) pagination.eq(iter).addClass('disabled')
            break;        
          default:
            if(link['active']) pagination.eq(iter).addClass('active')
            break;
        }
        pagination.eq(iter).empty().html( create_nav(iter, arr_limit, link)  )
        iter++
      })
      
      var content
      news_list = data['news_list']['data']
      news_list.forEach(news => {
        news_date = new Date(news.created_at)
        news_element = '<li class="list-group-item border-0"> <a href="'+ base_url + '/news/' + news.id  +'"> <div class="card border-0 shadow"> <div class="card-body"> <h1 class="card-title fw-bold text-dark mb-2 text-start">' + news.name + '</h1> <img class="d-block img-fluid object-contain w-25 mx-auto" src="' + base_url + '/storage/' + news.image + '"> <p class="text-end card-text text-muted">' + ("0" + news_date.getDate()).slice(-2) + '.' +  ("0" + (news_date.getMonth() + 1)).slice(-2)  + '.' + news_date.getFullYear() + ' г.</p> </div> </div> </a> </li>'
        content += news_element
      })
      $('#flist_news').empty().html(content)
    })
    .fail(function(jqXHR, ajaxOptions, thrownError){ alert('Нет ответа от сервера')  })
  }

  $(function () {
    $(document).on('click', '.pagination a', function(event)  {
      page_url = $(this).attr('href')
      window.history.pushState("", "", page_url)
      getAPIData(page_url.replace('?', '/api/?'))
    })
  });
</script>
@endsection