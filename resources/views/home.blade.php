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
@endsection
