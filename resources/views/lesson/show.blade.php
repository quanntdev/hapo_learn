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
                <div class="course-lesson">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab  @if (!session('success')) active  @endif" id="descriptions-tab" data-bs-toggle="tab" data-bs-target="#descriptions-tab-pane" type="button" role="tab" aria-controls="descriptions-tab-pane" aria-selected="true">{{ __('course-detail.lessons') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab @if (session('success')) active  @endif"  id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-tab-pane" type="button" role="tab" aria-controls="documents-tab-pane" aria-selected="false">{{ __('course-detail.programs') }}</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade @if (!session('success')) show active  @endif " id="descriptions-tab-pane" role="tabpanel" aria-labelledby="descriptions-tab" tabindex="0">
                            @if (!$lesson->IsJoined())
                            <form action="{{ route('user-lesson.store') }}" class="start-learn-lesson" method="POST">
                                @csrf
                                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                                <button type="submit">Start Learn Lesson</button>
                                <div class="clear"></div>
                            </form>
                            @elseif($lesson->IsFinished())
                            <div class="btn btn-danger btn-lesson-learned">You have finish this lesson</div>
                                <div class="clear"></div>
                            @else
                                <div class="btn btn-success btn-lesson-learned">You have learn this lesson</div>
                                <div class="clear"></div>
                            @endif
                            <div class="descriptons-item">
                                <div class="title">
                                    {{ __('lesson.description_lesson') }}
                                </div>
                                <div class="content">
                                    {{ $lesson->content }}
                                </div>
                            </div>
                            <div class="descriptons-item">
                                <div class="title">
                                    {{ __('lesson.requirements') }}
                                </div>
                                <div class="content">
                                    {{ $lesson->requirements }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if (session('success')) show active  @endif" id="documents-tab-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">
                            <div class="programs">
                                <div class="title">
                                    Programs
                                </div>
                                <div class="level-finish">
                                    <div class="side">
                                        <div>Your Level</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                          <div class="bar-status" style="width: {{ $lesson->Progress }}%"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        {{ $lesson->Progress }} %
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                @foreach ($lesson->programs as $key => $program)
                                <div class="programs-items">
                                    <div class="image">
                                        <img src="{{ asset('images/'.$program->programType['picture'].'.png') }}" alt="">
                                    </div>
                                    <div class="type">
                                        {{ $program->programType['type'] }}
                                    </div>
                                    <div class="name">
                                        {{ $program->program_name }}
                                    </div>
                                    <div class="link">
                                        @if ($lesson->IsJoined())
                                            @if (!$program->isLearned())
                                                <form action="{{ route('user-program.store') }}" method="POST">
                                                     @csrf
                                                    <input type="hidden" name="program_id" value="{{ $program->id }}">
                                                    <button class="button-link">preview</button>
                                                </form>
                                            @else
                                                <div class="have-join btn btn-success">
                                                    Complete
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                      </div>
                      <div class="line-tag">
                        <div class="tag-items title"> Tag :  </div>
                        @foreach ($tags as $key => $tag)
                        <div class="tag-items">
                            <a href="{{ route('course.index',['tags'=>[$tag->id]]) }}" class="tag-items-link">
                               # {{ $tag->tag_name }}
                            </a>
                        </div>
                        @endforeach
                        <div class="clear"></div>
                      </div>
                </div>
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
