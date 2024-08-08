@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
    <div class="card border border-light-subtle rounded-3 shadow-sm">
      <div class="card-body p-3 p-md-4 p-xl-5">
        <h2 class="fs-6 fw-normal text-center text-secondary mb-4">{{__('Сбросьте свой пароль')}}</h2>
        <form method="POST" action="{{ route('post.reset.password') }}">
          @csrf
          @method('put')
          @session('error')
            <div class="alert alert-danger" role="alert">{{ $value }}</div>
          @endsession
          <div class="row gy-2 overflow-hidden">
            <div class="col-12">
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Введите пароль" required>
                <label for="password" class="form-label">{{ __('Пароль') }}</label>
              </div>
              @error('password')
                <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
            <div class="col-12">
              <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" value="" placeholder="Повторите пароль" required>
                <label for="password_confirmation" class="form-label">{{ __('Подтвердить пароль') }}</label>
              </div>
              @error('password_confirmation')
                <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
            <div class="col-12">
              <div class="d-grid my-3">
                <button class="btn btn-primary btn-lg" type="submit">{{ __('Сохранить') }}</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection