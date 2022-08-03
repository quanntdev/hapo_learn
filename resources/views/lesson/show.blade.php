@extends('layouts.app')

@section('content')

<div class="container course-detail">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}" class="breadcrumb-link">Home</a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="{{ route('course.index') }}" class="breadcrumb-link">All Course</a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="{{ route('course.show',$lesson->course->slug_course) }}" class="breadcrumb-link">{{ $lesson->course->course_name }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $lesson->name_lesson }}</li>
        </ol>
    </nav>
</div>

<div class="course-detail-body">
    <div class="course-detail-container">
        <div class="row ">
            <div class="col-8 mt-4">
                <div class="course-image">
                    <img src="{{ $lesson->course->image }}" alt="">
                </div>
                @include('lesson.main_body')
            </div>
            <div class="col-3 ms-3 info-course">
                <div class="info">
                    <div class="info-items">
                        <div class="icon">
                            <i class="fa-solid fa-tv"></i>
                        </div>
                        <div class="title">
                            {{ __('course-detail.course') }}
                        </div>
                        <div class="content">
                            : {{ $lesson->course->course_name }}
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="info-items">
                        <div class="icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="title">
                            {{ __('course-detail.learner') }}
                        </div>
                        <div class="content">
                            : {{ $lesson->course->learners }}
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="info-items">
                        <div class="icon">
                            <i class="fa-solid fa-stopwatch"></i>
                        </div>
                        <div class="title">
                            {{ __('course-detail.time') }}
                        </div>
                        <div class="content">
                             {{ $lesson->course->times }} {{ __('course-detail.time_value') }}
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="info-items">
                        <div class="icon">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <div class="title">
                            {{ __('course-detail.tags') }}
                        </div>
                        <div class="content">
                            : @foreach ($tags as $key => $tag)
                            <a href="{{ route('course.index',['tags'=>[$tag->id]]) }}">#{{ $tag->tag_name }}</a>,
                            @endforeach
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="info-items">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                        <div class="title">
                            {{ __('course-detail.price') }}
                        </div>
                        <div class="content">
                            {{ $lesson->course->prices }}
                        </div>
                    </div>
                    @if ($lesson->course->isnotFinished)
                        <form action="{{ route('course-users.update',[$lesson->course->id]) }}" method="POST" class="form-end-course">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $lesson->course->id }}">
                            <button class="button-end-course" type="submit">{{ __('course-detail.end_course') }}</button>
                        </form>
                    @endif
                </div>
                @include('course.other_course')
            </div>
        </div>
    </div>
</div>
@endsection
