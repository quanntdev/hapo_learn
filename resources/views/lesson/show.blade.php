@extends('layouts.app')

@section('content')

<div class="container course-detail">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}" class="breadcrumb-link">Home</a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="" class="breadcrumb-link">All Course</a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="" class="breadcrumb-link">Lorem ipsum dolor sit.</a></li>
          <li class="breadcrumb-item active" aria-current="page">Lorem ipsum dolor sit amet consectetur.</li>
        </ol>
    </nav>
</div>

<div class="course-detail-body">
    <div class="course-detail-container">
        <div class="row ">
            <div class="col-8 mt-4">
                <div class="course-image">
                    <img src="https://www.hostinger.com/tutorials/wp-content/uploads/sites/2/2018/11/what-is-html-3.jpg" alt="">
                </div>
                @include('lesson.main_body')
            </div>
            <div class="col-3 ms-3 mt-4 info-course">
                {{-- @include('course.info_and_otherCourse') --}}
            </div>
        </div>
    </div>
</div>
@endsection
