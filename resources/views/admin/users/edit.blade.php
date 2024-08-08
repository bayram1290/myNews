@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <div class="float-start">Редактировать пользователя</div>
        <div class="float-end">
          <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">&larr; Назад</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
          @csrf
          @method("PUT")
          <div class="mb-3 row">
            <label for="login" class="col-md-4 col-form-label text-md-end text-start">Логин</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}">
                @if ($errors->has('login')) <span class="text-danger">{{ $errors->first('login') }}</span> @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="password" class="col-md-4 col-form-label text-md-end text-start">Пароль</label>
            <div class="col-md-6">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @if ($errors->has('password')) <span class="text-danger">{{ $errors->first('password') }}</span> @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Подтвердить пароль</label>
            <div class="col-md-6">
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
          </div>
          @if (Auth::user()->roles->pluck('name')[0] !== 'superAdmin')
            <div class="mb-3 row">
              <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Роли</label>
              <div class="col-md-6">           
                <select class="form-select @error('roles') is-invalid @enderror" multiple aria-label="Roles" id="roles" name="roles[]">
                  @forelse ($roles as $role)
                    @if ($role!='superAdmin') <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>{{ $role }} </option>
                    @else
                      @if (Auth::user()->hasRole('superAdmin'))   
                        <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>{{ $role }}</option>
                      @endif
                    @endif
                  @empty
                  @endforelse
                </select>
                @if ($errors->has('roles')) <span class="text-danger">{{ $errors->first('roles') }}</span> @endif
              </div>
            </div>
          @endif
          <div class="mb-3 row">
            <button type="submit" class="col-md-3 offset-md-5 btn btn-primary">Обновить пользователя</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection