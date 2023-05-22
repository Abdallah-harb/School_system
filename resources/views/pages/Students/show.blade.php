@extends('layouts.master')
@section('css')

@section('title')
    {{trans('Students_trans.All_students')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('Students_trans.All_students')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                   role="tab" aria-controls="home-02"
                                   aria-selected="true">{{trans('Students_trans.Student_details')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                   role="tab" aria-controls="profile-02"
                                   aria-selected="false">{{trans('Students_trans.Attachments')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                 aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{trans('Students_trans.name')}}</th>
                                        <td>{{ $student->name }}</td>
                                        <th scope="row">{{trans('Students_trans.email')}}</th>
                                        <td>{{$student->email}}</td>
                                        <th scope="row">{{trans('Students_trans.gender')}}</th>
                                        <td>{{$student->gender->name}}</td>
                                        <th scope="row">{{trans('Students_trans.Nationality')}}</th>
                                        <td>{{$student->Nationality->national_name}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">{{trans('Students_trans.Grade')}}</th>
                                        <td>{{ $student->grade->name }}</td>
                                        <th scope="row">{{trans('Students_trans.classrooms')}}</th>
                                        <td>{{$student->classroom->class_name}}</td>
                                        <th scope="row">{{trans('Students_trans.section')}}</th>
                                        <td>{{$student->section->section_name}}</td>
                                        <th scope="row">{{trans('Students_trans.Date_of_Birth')}}</th>
                                        <td>{{ $student->Date_Birth}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">{{trans('Students_trans.parent')}}</th>
                                        <td>{{ $student->myparent->Name_Father}}</td>
                                        <th scope="row">{{trans('Students_trans.academic_year')}}</th>
                                        <td>{{ $student->academic_year }}</td>
                                        <th scope="row"></th>
                                        <td></td>
                                        <th scope="row"></th>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                 aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{route('upload_image')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        for="academic_year">{{trans('Students_trans.Attachments')}}
                                                        : <span class="text-danger">*</span></label>
                                                    <input type="file" accept="image/*" name="photos[]" multiple required>
                                                    <input type="hidden" name="student_name" value="{{$student->name}}">
                                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{trans('Students_trans.submit')}}
                                            </button>
                                        </form>
                                    </div>
                                    <br>
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                           style="text-align:center">
                                        <thead>
                                        <tr class="table-secondary">
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('Students_trans.filename')}}</th>
                                            <th scope="col">{{trans('Students_trans.created_at')}}</th>
                                            <th scope="col">{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($student->images as $attachment)
                                            <tr style='text-align:center;vertical-align:middle'>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$attachment->filename}}</td>
                                                <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                <td colspan="2">
                                                    <a class="btn btn-outline-info btn-sm"
                                                       href="{{url('Download_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->filename}}"
                                                       role="button"><i class="fas fa-download"></i>&nbsp; {{trans('Students_trans.Download')}}</a>

                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_img{{ $attachment->id }}"
                                                            title="{{ trans('Grades_trans.Delete') }}">{{trans('Students_trans.Delete')}}
                                                    </button>

                                                </td>
                                            </tr>
                                            @include('pages.Students.Delete_img')
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- row closed -->
<!-- row closed -->
@endsection
@section('js')

@endsection