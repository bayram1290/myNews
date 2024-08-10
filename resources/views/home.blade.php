@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __(' Добро пожаловать: ') . Auth::user()->login }}</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert"> {{ session('status') }}</div>
          @endif
          @canany(['create-role', 'edit-role', 'delete-role'])
            <a class="btn btn-primary" href="{{ route('roles.index') }}">
              <i class="bi bi-person-fill-gear"></i> Управление ролями</a>
          @endcanany
          @canany(['create-user', 'edit-user', 'delete-user'])
            <a class="btn btn-success" href="{{ route('users.index') }}">
              <i class="bi bi-people"></i> Управление пользователями</a>
          @endcanany
          @canany(['create-news', 'edit-news', 'delete-news'])
            <a class="btn btn-warning" href="{{ route('news.index') }}">
            <i class="bi bi-bag"></i> Управление новостями</a>
          @endcanany
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container mt-4">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">Топ 5 новостей</div>
        <div class="card-body pb-0">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">№</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Содержание</th>
                <th class="col">Количество просмотров</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($top_news  as $news)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><a href="{{route('home.news', ['id' => $news->id])}}">{{implode(' ', array_slice(explode(' ', $news->name), 0, 5))}}</a></td>
                  <td>{{ implode(' ', array_slice(explode(' ', $news->description), 0, 10))}} ....</td>
                  <th class="text-center">{{ $news->total_views  }}</th>
                </tr>
              @empty
                <td colspan="4">
                  <span class="text-secondary"><strong>У новостей нет просмотров!</strong></span>
                </td>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Топ авторов</div>
        <div class="card-body pb-0">         
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">№</th>
                <th scope="col">Автор</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($top_authors as $author)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $author->login }}</td>
                </tr>
              @empty
                <td colspan="4">
                  <span class="text-secondary"><strong>У новостей нет просмотров!</strong></span>
                </td>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
