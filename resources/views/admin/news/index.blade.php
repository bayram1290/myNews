@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-header">Список новостей</div>
  <div class="card-body">
    @can('create-news')
      <a href="{{ route('news.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Добавить новость</a>
    @endcan
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">№</th>
          <th scope="col">Заголовок</th>
          <th scope="col">Содержание</th>
          <th scope="col">Действие</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($news_list as $news)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $news->name }}</td>
            <td>{{ $news->description }}</td>
            <td>
              <form action="{{ route('news.destroy', $news->id) }}" method="POST" class="d-flex flex-row">
                @csrf
                @method('DELETE')
                <a href="{{ route('home.news', $news->id) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-eye"></i> Отображать</a>

                @if (Auth::user()->login == $news->author ||  Auth::user()->hasRole('superAdmin'))
                  @can('edit-news') 
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square"></i> Редактировать</a>
                  @endcan
                  @can('delete-news')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы хотите удалить эту новость ?');"><i class="bi bi-trash"></i> Удалить</button>
                  @endcan
                @endif
              </form>
            </td>
          </tr>
        @empty
          <td colspan="4">
            <span class="text-danger"> <strong>Пока нет опубликованных новостей!</strong></span>
          </td>
        @endforelse
      </tbody>
    </table>
    {{ $news_list->links() }}
  </div>
</div>
@endsection
