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
@if (session('success'))
    <div class="toast toast-profile" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
        <div class="toast-header">
            <strong class="me-auto">HapoLearn</strong>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="getElementById('toast').classList.toggle('none')"></button>
        </div>
        <div class="toast-body text-success">
            {{ session('success') }}
        </div>
    </div>
@endif
@if( $errors->any())
<div class="toast toast-profile" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
    <div class="toast-header">
        <strong class="me-auto">HapoLearn</strong>
        <small>Now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="getElementById('toast').classList.toggle('none')"></button>
    </div>
    <div class="toast-body text-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
</div>
@endif
<div class="course-detail-body">
    <div class="course-detail-container">
        <div class="row ">
            <div class="col-8 mt-4 body-show-course">
                <div class="course-image">
                    <img src="{{ asset($lesson->course->image) }}" alt="">
                </div>
                <div class="course-lesson">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab  @if (!(session('success') || $errors->any())) active  @endif" id="descriptions-tab" data-bs-toggle="tab" data-bs-target="#descriptions-tab-pane" type="button" role="tab" aria-controls="descriptions-tab-pane" aria-selected="true">{{ __('course-detail.lessons') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab @if (session('success') || $errors->any()) active  @endif"  id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-tab-pane" type="button" role="tab" aria-controls="documents-tab-pane" aria-selected="false">{{ __('course-detail.programs') }}</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade @if (!(session('success') || $errors->any())) show active  @endif " id="descriptions-tab-pane" role="tabpanel" aria-labelledby="descriptions-tab" tabindex="0">
                            @cannot('view', auth()->user())
                                @include('components.lesson.learn-lesson-form')
                            @endcannot
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
                                    {{ $lesson->requirement }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if (session('success') || $errors->any()) show active  @endif" id="documents-tab-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">
                            <div class="programs">
                                <div class="title">
                                    Programs
                                </div>
                                @can('view', auth()->user())
                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Create a new program
                                    </button>
                                    <div class="clear"></div>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" style="max-width: 900px">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Create Programs') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            <div class="modal-body">
                                                @include('components.lesson.create-programs')
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endcan
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
                                @foreach ($programs as $key => $program)
                                <div class="programs-items">
                                    <div class="image">
                                        <img src="{{ asset('images/'.$program->programType['picture'].'.png') }}" alt="">
                                    </div>
                                    <div class="type">
                                        {{ $program->programType['type'] }}
                                    </div>
                                    <div class="name">
                                       <a  @if ($lesson->IsJoined()) href="{{ $program->file }}" @endif target="_blank" class="text-body">{{ $program->program_name }}</a>
                                        @can('view', auth()->user())
                                             @if ($program->status == config('course.onstatus'))
                                                <a class="text-success">( Active )</a>
                                            @else
                                                <a class="text-danger">( NotActive )</a>
                                            @endif
                                            @endcan
                                    </div>
                                    @cannot('view', auth()->user())
                                        @include('components.lesson.learn-program-form')
                                    @endcannot
                                    @can('view', auth()->user())
                                        <div class="action d-flex">
                                            <button type="button" class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#exampleModal{{$program->id}}">
                                                Edit
                                            </button>
                                            <div class="clear"></div>
                                            <div class="modal fade" id="exampleModal{{$program->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$program->id}}" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 900px">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Create Programs') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    <div class="modal-body">
                                                        @include('components.lesson.edit-programs')
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                            </form>
                                        </div>
                                    @endcan
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
                @include('components.course.other-course')
            </div>
        </div>
    </div>
</div>
@endsection
