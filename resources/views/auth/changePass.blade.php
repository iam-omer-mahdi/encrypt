@extends('layouts.app')

@section('content')
  <div class="bg-white border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-3 justify-content-center m-0">
          <li class="breadcrumb-item"><a class="text-success" href="{{ route('membership.index') }}">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page">تغيير كلمة المرور</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container py-4 mt-4">
      <div class="card shadow">
        <div class="card-header bg-success text-white">
          <h4 class="d-flex align-items-center m-0">
            <i class="lnr lnr-lock me-2"></i>
            تغير كلمة المرور
          </h4>
        </div>
        
        <div class="card-body">
          <form action="{{ route('updatePass',$user->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
              <label for="old_password" class="form-label">كلمة المرور الحالية</label>
              <input type="password" name="old_password" id="old_password" class="form-control @if(Session::has('error')) border-danger @endif" required>
              @if (Session::has('error'))
                <small class="text-danger">
                  {{ Session::get('error') }}
                </small>
              @endif
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">كلمة المرور الجديدة</label>
              <input type="password" name="password" id="password" class="form-control @error('password') border-danger @enderror" required>
              @error('password')
                <small class="text-danger">
                  {{ $message }}
                </small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">تأكيد كلمة المرور </label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
              @error('password_confirmation')
                <small class="text-danger">
                  {{ $message }}
                </small>
              @enderror
            </div>
          
            <button type="submit" class="btn-success btn w-100 shadow-sm">تغيير</button>
          </form>
        </div>
      </div>
  </div>
@stop