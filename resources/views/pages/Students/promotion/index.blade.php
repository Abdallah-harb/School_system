@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{trans('Students_trans.student_promotion')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('Students_trans.student_promotion')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <h6 style="color: red;font-family: Cairo">  {{trans('Students_trans.Old_grade')}}</h6><br>

                    <form method="post" action="{{ route('promotion.store')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id" required>
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{$Grade->id}}">{{$Grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id" required>

                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" name="section_id" required>

                                </select>
                            </div>
                        </div>
                        <br><h6 style="color: red;font-family: Cairo">{{trans('Students_trans.new_grade')}}</h6><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id_new" >
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{$Grade->id}}">{{$Grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Students_trans.classrooms')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id_new" >

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">:{{trans('Students_trans.section')}} </label>
                                <select class="custom-select mr-sm-2" name="section_id_new" >

                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans('Students_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
@section('js')

    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                const classroomSelect = $('select[name="Classroom_id"]');
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id, // THIS IS ROUTE
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            classroomSelect.empty();
                            classroomSelect.append('<option value="" disabled>{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                const option = $('<option></option>').attr('value', key).text(value);
                                classroomSelect.append(option);
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="Classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                const section_id = $('select[name="section_id"]');
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id, // THIS IS ROUTE
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            section_id.empty();
                            section_id.append('<option value="" disabled>{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                const option = $('<option></option>').attr('value', key).text(value);
                                section_id.append(option);
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="Grade_id_new"]').on('change', function () {
                var Grade_id_new = $(this).val();
                const classroomSelect = $('select[name="Classroom_id_new"]');
                if (Grade_id_new) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id_new, // THIS IS ROUTE
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            classroomSelect.empty();
                            classroomSelect.append('<option value="" disabled>{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                const option = $('<option></option>').attr('value', key).text(value);
                                classroomSelect.append(option);
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(() => {
            $('select[name="Classroom_id_new"]').on('change', () => {
                const classroomId = $('select[name="Classroom_id_new"]').val();
                if (classroomId) {
                    fetch(`/Get_Sections/${classroomId}`)
                        .then(response => response.json())
                        .then(data => {
                            $('select[name="section_id_new"]').empty();
                            $.each(data, (key, value) => {
                                $('select[name="section_id_new"]').append(`<option value="${key}">${value}</option>`);
                            });
                        })
                        .catch(error => {
                            console.error(`Error occurred: ${error}`);
                        });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

@endsection
