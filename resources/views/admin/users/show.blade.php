@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <div class="float-start">Список пользователей</div>
        <div class="float-end"><a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">&larr; Назад</a> </div>
      </div>
      <div class="card-body">
        <div class="mb-3 row">
          <label for="login" class="col-md-4 col-form-label text-md-end text-start"><strong>Логин:</strong></label>
          <div class="col-md-6 lh-lg">{{ $user->login }}</div>
        </div>
        <div class="mb-3 row">
          <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Роли:</strong></label>
          <div class="col-md-6 lh-lg">
            @forelse ($user->getRoleNames() as $role) <span class="badge bg-primary">{{ $role }}</span>
            @empty
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection