@extends('layouts.master')

@section('title')
قائمة الواردات
@stop

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الواردات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المصروفات</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

                 @if (session()->has('delete_income'))
                        <script>
                             window.onload = function() {
                            notif({
                               msg: "تم حذف  بنجاح",
                               type: "success"
                             })
                            }
                         </script>
                @endif


				<!-- row -->
				<div class="row">




                        <!--div-->
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">

                                            <a href="incomes/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                            class="fas fa-plus"></i>&nbsp; اضافة وارد</a>

                                            <a class="modal-effect btn btn-sm btn-primary" href="{{ url('incomes_export') }}"
                                            style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>

                                </div>



                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">الوارد </th>
                                                    <th class="border-bottom-0">المبلغ</th>
                                                    <th class="border-bottom-0">التاريخ</th>
                                                    <th class="border-bottom-0">الملاحظات</th>
                                                    <th class="border-bottom-0">العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($incomes as $income)

                                                @php
                                                    $i++
                                                @endphp

                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $income->incomeName }}</td>
                                                        <td>{{ $income->incomePrice }}</td>
                                                        <td>{{ $income->incomeDate }}</td>
                                                        <td>{{ $income->notes }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button aria-expanded="false" aria-haspopup="true"
                                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                                <div class="dropdown-menu tx-13">

                                                                        <a class="dropdown-item"
                                                                            href=" {{url('edit_income') }}/{{ $income->id }}">تعديل
                                                                            </a>

                                                                            <a class="dropdown-item" href="#" data-income_id="{{ $income->id }}"
                                                                                data-toggle="modal" data-target="#delete_income"><i
                                                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                                </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="delete_income" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">حذف</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <form action="{{ route('incomes.destroy', 'test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                </div>
                                <div class="modal-body">
                                    هل انت متاكد من عملية الحذف ؟
                                    <input type="text" name="income_id" id="income_id" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                        <!--/div-->
                        </div>
                        </div>
                        </div>



				</div>

@endsection

@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>


    <script>
        $('#delete_income').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var income_id = button.data('income_id')
            var modal = $(this)
            modal.find('.modal-body #income_id').val(income_id);
        })
    </script>

@endsection
