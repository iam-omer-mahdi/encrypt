@extends('layouts.app')

@section('content')
  <div class="bg-white border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-3 justify-content-center m-0">
          <li class="breadcrumb-item"><a class="text-success" href="{{ route('membership.index') }}">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page">تعديل عضوية</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container py-4 text-start mt-4">
      <div class="card shadow">
        <div class="card-header bg-success text-white">
          <h4 class="d-flex align-items-center m-0">
            <i class="lnr lnr-plus-circle me-2"></i>
            تعديل عضوية
          </h4>
        </div>
        
        <div class="card-body">
          <form action="{{ route('membership.update',$membership->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
              <div class="col">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Crypt::decrypt($membership->name) }}" required>
                @error('name')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="col">
                <label for="sex" class="form-label">الجنس</label>
                <select class="form-select" id="sex" name="sex" required>
                  <option value="male" @if(Crypt::decrypt($membership->sex) == 'male') selected @endif>ذكر</option>
                  <option value="female" @if(Crypt::decrypt($membership->sex) == 'female') selected @endif>انثي</option>
                </select>
                @error('sex')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="col-3">
                <label for="age" class="form-label">العمر</label>
                <input type="number" step="1" class="form-control" id="age" name="age" value="{{ Crypt::decrypt($membership->age) }}" required>
                @error('age')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="phone" class="form-label">الهاتف</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ Crypt::decrypt($membership->phone) }}" required>
                @error('phone')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="col">
                <label for="national_number" class="form-label">الرقم الوطني</label>
                <input type="number" class="form-control" id="national_number" name="national_number" value="{{ Crypt::decrypt($membership->national_number) }}" required>
                @error('national_number')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="state" class="form-label">الولاية</label>
                <select class="form-select" id="state" name="state_id" value="{{ old('state_id') }}" required>
                  @foreach ($states as $state)
                    <option value="{{$state->id}}" @if (Crypt::decrypt($membership->state_id) == $state->id) selected @endif>{{ Crypt::decrypt($state->name) }}</option>
                  @endforeach
                </select>
                @error('state_id')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="col">
                <label for="district" class="form-label">المحلية</label>
                <input type="text" name="district" id="district" class="form-control" required value="{{ Crypt::decrypt($membership->district) }}" required>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col">
                <label for="qualification" class="form-label">المؤهل الدراسي</label>
                <select class="form-select" id="qualification" name="qualification_id" value="{{ old('qualification_id') }}" required>
                  @foreach ($qualifications as $qualification)
                    <option value="{{$qualification->id}}" @if (Crypt::decrypt($membership->qualification_id) == $qualification->id) selected @endif>{{ Crypt::decrypt($qualification->name) }}</option>
                  @endforeach
                </select>
                @error('qualification_id')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="col">
                <label for="joining_date" class="form-label">تاريخ الانضمام</label>
                <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ Crypt::decrypt($membership->joining_date) }}" required>
                @error('joining_date')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
              <div class="col-12 mt-2">
                <label for="form_number" class="form-label">رقم الاستمارة</label>
                <input type="number" class="form-control" id="form_number" name="form_number" value="{{ Crypt::decrypt($membership->form_number) }}" required>
                @error('form_number')
                  <small class="text-danger">
                    {{ $message }}
                  </small>
                @enderror
              </div>
            </div>
            <button type="submit" class="btn-success btn w-100 shadow-sm">تعديل</button>
          </form>
        </div>
      </div>
  </div>
@stop