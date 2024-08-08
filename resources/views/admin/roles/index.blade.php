@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-header">Управление ролями</div>
  <div class="card-body">
    @can('create-role')
      <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Добавить новую роль</a>
    @endcan
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">№</th>
          <th scope="col">Наименование</th>
          <th scope="col">Действие</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($roles as $role)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $role->name }}</td>
          <td>
            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-flex flex-row">
              @csrf
              @method('DELETE')
              <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-eye"></i>Отображать</a>
                @if ($role->name!='superAdmin')
                  @can('edit-role')
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square"></i> Редактировать</a>   
                  @endcan
                  @can('delete-role')
                    @if ($role->name!=Auth::user()->hasRole($role->name))
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы хотите удалить эту роль?');"><i class="bi bi-trash"></i> Удалить</button>
                    @endif
                  @endcan
                @endif
              </form>
          </td>
        </tr>
        @empty
          <td colspan="3">
            <span class="text-danger">
              <strong>Роль не найдена!</strong>
            </span>
          </td>
        @endforelse
      </tbody>
    </table>
    {{ $roles->links() }}
  </div>
</div>
@endsection