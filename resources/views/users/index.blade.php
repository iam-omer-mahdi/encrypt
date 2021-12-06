@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="{{ asset('css/noty.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nest.css') }}">
  <link rel="stylesheet" href="{{ asset('css/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.buttons.css') }}"/>
@endpush

@section('content')
<div class="bg-white border-bottom">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center m-0 py-3">
        <li class="breadcrumb-item"><a class="text-success" href="{{ route('membership.index') }}">الرئيسية</a></li>
        <li class="breadcrumb-item active" aria-current="page">المستخدمين</li>
      </ol>
    </nav>
  </div>
</div>

<div class="container py-4 mt-4">
  <a href="{{ route('users.create') }}" class="btn btn-success mb-2 shadow">اضافة مستخدم</a>
  <div class="card shadow">
      <div class="card-header bg-success text-white d-flex justify-content-center align-items-center">
          <h4 class="m-0">قائمة المستخدمين</h4>
      </div>
      <div class="card-body">

      <div class="table-responsive">
          <table class="table table-striped align-middle bg-white m-0" id="table">
              <thead class="text-muted">
                  <tr>
                      <th>اسم المستخدم</th>   
                      <th>الاسم</th>
                      <th>البريد الالكتروني</th>
                      <th>الهاتف</th>
                      <th>الدور</th>
                      <th> </th>
                  </tr>
              </thead>
              <tbody>
                @if($users)
                  @foreach ($users as $user)  
                    <tr>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phone }}</td>
                      <td>
                        @switch($user->role)
                            @case('user')
                                 مستخدم
                                @break
                            @case('admin')
                                مشرف
                                @break
                            @case('superAdmin')
                                مدير
                                @break
                            @default
                        @endswitch
                      </td>
                      @if ($user->role === 'user' || auth()->user()->role === 'superAdmin' && $user->role !== 'superAdmin')
                        <td>
                          <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></a>
                          <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')  
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل انت مأكد من حذف هذا المستخدم؟')"><i class="lnr lnr-trash"></i></button>
                          </form>
                        </td>
                      @else
                        <td> </td>
                      @endif
                    </tr>
                  @endforeach
                @endif
              </tbody>
          </table>
      </div>
  </div>
</div>

@endsection

@push('js')
  <script src="{{asset('js/jquery.js')}}"></script>
  <script src="{{asset('js/datatables.min.js')}}" ></script>
  <script src="{{asset('js/datatables.bootstrap5.js')}}"></script>
  <script type="{{asset('js/datatables.buttons.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/datatables.html5.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/datatables.print.min.js') }}"></script>
  <script src="{{ asset('js/noty.min.js') }}"></script>
  <script>
      $(document).ready( function () {
          $('#table').DataTable({
              dom: 'Bfrtip',
                buttons: [
                    // { extend: 'copy', text: 'نسخ' }, 
                    { extend: 'print', text: 'طباعة' }, 
              ],
              "language": 
                      {
                          "sProcessing": "جارٍ التحميل...",
                          "sLengthMenu": "أظهر _MENU_ مدخلات",
                          "sZeroRecords": "لم يعثر على أية سجلات",
                          "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                          "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                          "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                          "sInfoPostFix": "",
                          "sSearch": "ابحث:",
                          "sUrl": "",
                          "oPaginate": {
                              "sFirst": "الأول",
                              "sPrevious": "السابق",
                              "sNext": "التالي",
                              "sLast": "الأخير"
                          }
                      }
          });
      } );
  </script>
  <script>
    @if (Session::has('success'))
    new Noty({
      theme: 'nest',
      type: 'success',
      layout: 'topRight',
      text: '{{ Session::get('success') }}',
    }).show();
    @endif
  </script>
@endpush

