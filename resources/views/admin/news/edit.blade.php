@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <div class="float-start">Редактировать новости</div>
        <div class="float-end">
          <a href="{{ route('news.index') }}" class="btn btn-primary btn-sm">&larr; Назад</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('news.update', $news->id) }}" method="POST">
          @csrf
          @method("PUT")
          @session('error')
            <div class="alert alert-danger" role="alert">{{ $value }}</div>
          @endsession

          @if (session('status'))
            <div>Errors</div>
          @endif
          <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Заголовок</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $news->name }}">
              @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="description" class="col-md-4 col-form-label text-md-end text-start">Содержание</label>
            <div class="col-md-6">
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $news->description }}</textarea>
              @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
              @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="image" class="col-md-4 col-form-label text-md-end text-start">{{ __('Новостное изображение') }}</label>
            <div class="col-md-6">
              <input type="file" class="form-control" id="image" name="image" >
            </div>
          </div>
          <div class="mb-3 row">
            <button type="submit" class="col-md-3 offset-md-5 btn btn-primary">Обновить и опубликовать</button>
          </div>
        </form>
      </div>
    </div>
  </div>    
</div>
@endsection