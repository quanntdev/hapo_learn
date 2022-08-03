@extends('layouts.app')

@section('content')

@php
    $rate = round($course->rates / $comments->count());
@endphp

<div class="container course-detail">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}" class="breadcrumb-link">Home</a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="{{ route('course.index') }}" class="breadcrumb-link">All Course</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $course->course_name }}</li>
        </ol>
    </nav>
</div>

<div class="course-detail-body">
    <div class="course-detail-container">
        <div class="row ">
            <div class="col-8 mt-4">
                <div class="course-image">
                    <img src="{{ $course->image }}" alt="">
                </div>
                @include('course.main_body')
            </div>
            <div class="col-3 ms-3 mt-4 info-course">
                <div class="description">
                    <div class="title">
                        {{ __('course-detail.description') }}
                    </div>
                    <div class="content">
                        {{ $course->description }}
                    </div>
                </div>
                @include('course.info_and_other_course')
            </div>
        </div>
    </div>
</div>
@endsection
