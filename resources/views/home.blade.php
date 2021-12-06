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
        <ol class="breadcrumb py-3 justify-content-center m-0">
            <li class="breadcrumb-item active" aria-current="page">الرئيسية</li>
        </ol>
        </nav>
    </div>
</div>

<div class="container-fluid px-2 pb-4 mt-4">
    <a href="{{ route('membership.create') }}" class="btn btn-success shadow mb-2"> <i class="lnr lnr-user me-2"></i>اضافة عضوية</a>
    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h4 class="m-0">قائمة العضويات</h4>
        </div>
        <div class="card-body ">

        <div class="table-responsive">
            <table class="table table-striped align-middle bg-white m-0" id="table">
                <thead class="text-muted">
                    <tr>
                        <th>الاسم</th>
                        <th>العمر</th>
                        <th>الجنس</th>
                        <th>الهاتف</th>
                        <th>الرقم الوطني</th>
                        <th>الولاية</th>
                        <th>المحلية</th>
                        <th>المؤهل الدراسي</th>
                        <th>تاريخ الانضمام</th>
                        <th>رقم الاستمارة</th>
                        @canany(['is-admin','is-superAdmin'])
                            <th></th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @if ($memberships && count($memberships) > 0)
                        @foreach ($memberships as $membership)    
                            <tr>
                                <td>{{ Crypt::decrypt($membership->name) }}</td>
                                <td>{{ Crypt::decrypt($membership->age) }}</td>
                                <td>@if(Crypt::decrypt($membership->sex) == 'male') ذكر @else انثي @endif</td>
                                <td>{{ Crypt::decrypt($membership->phone) }}</td>
                                <td>{{ Crypt::decrypt($membership->national_number) }}</td>
                                <td>{{ Crypt::decrypt($states[Crypt::decrypt($membership->state_id)-1]->name) }}</td>
                                <td>{{ Crypt::decrypt($membership->district) }}</td>
                                <td>{{ Crypt::decrypt($qualifications[Crypt::decrypt($membership->qualification_id)-1]->name) }}</td>
                                <td>{{ Crypt::decrypt($membership->joining_date) }}</td>
                                <td>{{ Crypt::decrypt($membership->form_number) }}</td>
                                @canany(['is-admin','is-superAdmin'])
                                    <td>
                                        <a href="{{ route('membership.edit',$membership->id) }}" class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></a>
                                        <form action="{{ route('membership.destroy', $membership->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل انت متأكد من حذف العضوية؟')"><i class="lnr lnr-trash"></i></button>
                                        </form>
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    </div> <!-- Card -->
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
            var loading = true;
            $('#table').DataTable({
                "deferRender": true,
                "processing": true,
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
        @if (Session::has('error'))
        new Noty({
          theme: 'nest',
          type: 'error',
          layout: 'topRight',
          text: '{{ Session::get('error') }}',
        }).show();
        @endif
      </script>
@endpush