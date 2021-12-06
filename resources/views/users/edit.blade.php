@extends('layouts.app')

@section('content')
  <div class="bg-white border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-3 justify-content-center m-0">
          <li class="breadcrumb-item"><a class="text-success" href="{{ route('membership.index') }}">الرئيسية</a></li>
          <li class="breadcrumb-item"><a class="text-success" href="{{ route('users.index') }}">المستخدمين</a></li>
          <li class="breadcrumb-item active" aria-current="page">تعديل مستخدم</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container py-4 mt-4">
      <div class="card shadow">
        <div class="card-header bg-success text-white">
          <h4 class="d-flex align-items-center m-0">
            <i class="lnr lnr-user me-2"></i>
            تعديل مستخدم
          </h4>
        </div>
        
        <div class="card-body">
          <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
              <div class="col-12 col-md-6 mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" name="name" id="name" class="form-control @error('name') border-danger @enderror" required value="{{ $user->name }}">
                @error('name')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="col-12 col-md-6 mb-3">
                <label for="username" class="form-label">اسم المستخدم</label>
                <input type="text" name="username" id="username" class="form-control @error('username') border-danger @enderror" required value="{{ $user->username }}">
                <small class="text-secondary d-block @error('username') d-none @enderror">
                  سيتم استخدام اسم المستخدم لتسجيل الدخول
                </small>
                @error('username')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-6 mb-3">
                <label for="phone" class="form-label">الهاتف</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                @error('phone')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="col-12 col-md-6 mb-3">
                <label for="email" class="form-label">البريد الالكتروني</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                @error('email')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
            </div>
            
            <div class="mb-3">
              <strong class="mb-2 d-block">الصلاحيات :-</strong>
              <div class="form-check">
                <input type="radio" name="role" id="admin" class="form-check-input" value="admin" @if($user->role == 'admin') checked @endif>
                <label for="admin" class="form-check-label">مدير</label>
              </div>
              <div class="form-check">
                <input type="radio" name="role" id="role" class="form-check-input" value="user" @if($user->role == 'user') checked @endif>
                <label for="email" class="form-check-label">مستخدم</label>
              </div>
              @error('role')
                <small class="text-danger">
                  {{ $message }}
                </small>
              @enderror
            </div>
          
            <button type="submit" class="btn-success btn w-100 shadow-sm">تعديل</button>
          </form>
        </div>
      </div>
  </div>
@stop