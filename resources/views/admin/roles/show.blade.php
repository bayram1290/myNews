@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <div class="float-start">Ролевая информация</div>
        <div class="float-end">
          <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Назад</a>
        </div>
      </div>
        <div class="card-body">
          <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Название:</strong></label>
            <div class="col-md-6 lh-lg"> {{ $role->name }}</div>
          </div>
          <div class="mb-3 row">
            <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Права доступа:</strong></label>
            <div class="col-md-6 lh-lg">
              @if ($role->name=='superAdmin') <span class="badge bg-primary">Все</span>
              @else
                @forelse ($rolePermissions as $permission)
                  <span class="badge bg-primary">{{ $permission->name }}</span>
                @empty
                @endforelse
              @endif
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection