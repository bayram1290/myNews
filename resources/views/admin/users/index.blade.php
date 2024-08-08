@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header">Управление пользователями</div>
  <div class="card-body">
    @can('create-user')
      <a href="{{ route('users.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Добавить нового пользователя</a>
    @endcan
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">№</th>
          <th scope="col">Логин</th>
          <th scope="col">Роли</th>
          <th scope="col">Действие</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $user->login }}</td>
            <td>
              @forelse ($user->getRoleNames() as $role)
                <span class="badge bg-primary">{{ $role }}</span>
              @empty
              @endforelse
            </td>
            <td>
              <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Отображать</a>
                @if (in_array('superAdmin', $user->getRoleNames()->toArray() ?? []) )
                  @if (Auth::user()->hasRole('superAdmin'))
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Редактировать</a>
                  @endif
                @else
                  @can('edit-user')
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Редактировать</a>   
                  @endcan
                  @can('delete-user')
                    @if (Auth::user()->id!=$user->id)
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы хотите удалить этого пользователя ?');"><i class="bi bi-trash"></i> Удалить</button>
                    @endif
                  @endcan
                @endif
              </form>
            </td>
          </tr>
          @empty
            <td colspan="5">
              <span class="text-danger"><strong>Пока нет пользователя!</strong></span>
            </td>
          @endforelse
      </tbody>
    </table>
    {{ $users->links() }}
  </div>
</div>
@endsection