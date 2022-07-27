@extends('layouts.app')

@section('content')

<div class="container all-course-body">
    <div class="gruop-filter">
        <button class="btn btn-filter" id="filter-btn"><i class="fa-solid fa-arrow-down-wide-short"></i> Filter</button>
        <div class="gruop-search">
            <form role="search" method="GET" action="{{url('search')}}">
                <input type="text" placeholder="{{ __('all-course.input_placeholder') }}" name="key_search" required value="{{ $keySearch }}">
                <div class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <button class="btn btn-search">{{ __('all-course.input_placeholder') }}</button>
            </form>
        </div>
    </div>
    <div class="box-filter" id="filter-content">
        <div class="row">
            <div class="col-1 title">{{ __('all-course.sort_by') }}</div>
            <div class="col-11">
                <div class="btn-option on-select">
                    <button>{{ __('all-course.last_est') }}</button>
                </div>
                <div class="btn-option">
                    <button>{{ __('all-course.old_est') }}</button>
                </div>
                <div class="btn-option">
                    <select name="" id="">
                        <option>{{ __('all-course.teacher') }}</option>
                        @foreach ($teachers as $key => $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="btn-option">
                    <select name="" id="">
                        <option>{{__('all-course.number_student')}}</option>
                        <option value="{{ config('all-course.low_to_high') }}">{{ __('all-course.ascending') }}</option>
                        <option value="{{ config('all-course.high_to_low') }}">{{ __('all-course.descending') }}</option>
                    </select>
                </div>
                <div class="btn-option">
                    <select name="" id="">
                        <option>{{__('all-course.time')}}</option>
                        <option value="{{ config('all-course.low_to_high') }}">{{ __('all-course.ascending') }}</option>
                        <option value="{{ config('all-course.high_to_low') }}">{{ __('all-course.descending') }}</option>
                    </select>
                </div>
                <div class="btn-option">
                    <select name="" id="">
                        <option>{{__('all-course.number_lesson')}}</option>
                        <option value="{{ config('all-course.low_to_high') }}">{{ __('all-course.most') }}</option>
                        <option value="{{ config('all-course.high_to_low') }}">{{ __('all-course.least') }}</option>
                    </select>
                </div>
                <div class="btn-option">
                    <select name="" id="">
                        <option>{{__('all-course.tags')}}</option>
                        @foreach ($tags as $key => $tag)
                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="btn-option">
                    <select name="" id="">
                        <option>{{__('all-course.review')}}</option>
                        <option value="{{ config('all-course.low_to_high') }}">{{ __('all-course.ascending') }}</option>
                        <option value="{{ config('all-course.high_to_low') }}">{{ __('all-course.descending') }}</option>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="list-course">
        <div class="search_key_title">
            {{ __('all-course.search_result') }}  <span> {{ $keySearch }} </span>
        </div>
        @if($courses->count() == 0 )
            <div class="no-course">
                <div class="no-course-icon"><i class="fa-solid fa-sad-tear"></i></div>
                <div class="no-course-text">{{ __('all-course.no_course') }} "<span>{{ $keySearch }}</span>" </div>
            </div>
        @endif
        @foreach ($courses as $key => $course)
        <div class="item float-start">
            <div class="course-content">
                <div class="row">
                    <div class="col-2">
                        <img src="{{ $course->image }}" alt="" class="img-course">
                    </div>
                    <div class="col-10">
                        <div class="title">
                            {{ $course->course_name }}
                        </div>
                        <div class="content">
                            {{ $course->description }}
                        </div>
                        <div class="btn-learn">
                            <a href="">More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="course-statics">
                <div class="course-statics-items">
                    <div class="title">
                        Learners
                    </div>
                    <div class="statics">
                        {{ $course->users->count() }}
                    </div>
                </div>
                <div class="course-statics-items">
                    <div class="title">
                        Lessons
                    </div>
                    <div class="statics">
                        {{ $course->lessons->count() }}
                    </div>
                </div>
                <div class="course-statics-items">
                    <div class="title">
                        Times
                    </div>
                    <div class="statics">
                        {{ $course->time_lesson }} {{__('all-course.hour')}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="clear"></div>
    </div>

</div>
@endsection
