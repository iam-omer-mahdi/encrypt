@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column min-vh-100 justify-content-center align-items-center">
    <div class="col-12 col-sm-10 col-md-7 mx-auto">
        <div class="card border-0 shadow">
            <div class="text-center card-header bg-success text-white">تسجيل الدخول</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">اسم المستخدم</label>
                        <input id="username" type="text" class="form-control @error('username') border-danger @enderror" name="username" value="{{ old('username') }}" required autofocus autocomplete="off">
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input id="password" type="password" class="form-control @error('password') border-danger @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success text-white w-100">تسجيل الدخول</button>
                    <a class="mt-2 d-block text-success" href="{{ route('password.request',) }}">هل نسيت كلمة السر ؟</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
