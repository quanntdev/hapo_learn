@extends('layouts.app')

@section('content')

<div class="container all-course-body">
    <div class="gruop-filter">
        <button class="btn btn-filter" id="filter-btn"><i class="fa-solid fa-arrow-down-wide-short"></i> Filter</button>
        <div class="gruop-search">
            <form role="search" method="GET" action="{{ route('course.index') }}">
                <input type="text"
                    placeholder="{{ __('all-course.input_placeholder') }}"
                    name="keyword" id="search_input"
                    @if( isset($data['keyword'] ) && $data['keyword'] != ''  ) value="{{ $data['keyword'] }}" @endif>
                <div class="search-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <button class="btn btn-search" type="submit">{{ __('all-course.input_placeholder') }}</button>
        </div>
    </div>
    <div class="box-filter @if (isset($data['created_time'])) active  @endif " id="filter-content">
        <div class="row">
            <div class="col-1 title">{{ __('all-course.sort_by') }}</div>
            <div class="col-11">
                <div class="btn-option">
                        <div class="inputGroup">
                            <input id="radio1"
                                    name="created_time"
                                    @if ( !isset($data['created_time']) or $data['created_time'] ==  config('all-course.high_to_low') or $data['lastest'] = '' ) checked  @endif type="radio"
                                    value="{{ config('all-course.high_to_low') }}"/>
                            <label for="radio1">{{ __('all-course.last_est') }}</label>
                        </div>
                </div>
                <div class="btn-option" >
                    <div class="inputGroup">
                        <input id="radio2"
                                name="created_time"
                                type="radio"
                                @if ((isset($data['created_time']) && $data['created_time'] !=  config('all-course.high_to_low'))) checked  @endif
                                value="{{ config('all-course.low_to_high') }}"/>
                        <label for="radio2">{{ __('all-course.old_est') }}</label>
                    </div>
                </div>
                <div class="btn-option">
                    <select name="learners" class="sort" id="sort-student">
                        <option value="">{{__('all-course.number_student')}}</option>
                        <option {{ (isset($data['learners']) && $data['learners'] == config('all-course.low_to_high')) ? 'selected' : '' }}
                                value="{{ config('all-course.low_to_high') }}">
                                {{ __('all-course.ascending') }}
                        </option>
                        <option {{ (isset($data['learners']) && $data['learners'] == config('all-course.high_to_low')) ? 'selected' : '' }}
                                value="{{ config('all-course.high_to_low') }}">
                                {{ __('all-course.descending') }}
                        </option>
                    </select>
                </div>
                <div class="btn-option">
                    <select name="time" class="sort" id="sort-time">
                        <option value="">{{ __('all-course.time') }}</option>
                        <option {{ (isset($data['time']) && $data['time'] == config('all-course.low_to_high')) ? 'selected' : '' }}
                            value="{{ config('all-course.low_to_high') }}">
                            {{ __('all-course.ascending') }}
                        </option>
                        <option {{ (isset($data['time']) && $data['time'] == config('all-course.high_to_low')) ? 'selected' : '' }}
                            value="{{ config('all-course.high_to_low') }}">
                            {{ __('all-course.descending') }}
                        </option>
                    </select>
                </div>
                <div class="btn-option">
                    <select name="lesson" id="sort-lesson" class="sort">
                        <option value="">{{__('all-course.number_lesson')}}</option>
                        <option {{ (isset($data['lesson']) && $data['lesson'] == config('all-course.low_to_high')) ? 'selected' : '' }}
                            value="{{ config('all-course.low_to_high') }}">
                            {{ __('all-course.most') }}
                        </option>
                        <option {{ (isset($data['lesson']) && $data['lesson'] == config('all-course.high_to_low')) ? 'selected' : '' }}
                             value="{{ config('all-course.high_to_low') }}">
                             {{ __('all-course.least') }}
                        </option>
                    </select>
                </div>
                <div class="btn-option">
                    <select name="comment" id="sort-comment" class="sort">
                        <option value="">{{__('all-course.review')}}</option>
                        <option {{ (isset($data['comment']) && $data['comment'] == config('all-course.low_to_high')) ? 'selected' : '' }}
                             value="{{ config('all-course.low_to_high') }}">
                             {{ __('all-course.ascending') }}
                        </option>
                        <option {{ (isset($data['comment']) && $data['comment'] == config('all-course.high_to_low')) ? 'selected' : '' }}
                            value="{{ config('all-course.high_to_low') }}">
                            {{ __('all-course.descending') }}
                        </option>
                    </select>
                </div>
                <div class="btn-option">
                    <select class="js-example-basic-single" name="tags[]" multiple>
                        <option value="" {{ (!isset($data['tags'])) ? 'selected' : ''}} disabled>{{__('all-course.tags')}}</option>
                        @foreach ($tags as $key => $tag)
                            <option  {{ (isset($data['tags']) && in_array($tag->id, $data['tags'])) ? 'selected' : ''}} value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="btn-option">
                    <select class="js-example-basic-single" name="teacher[]" multiple>
                        <option value="" {{ (!isset($data['teacher'])) ? 'selected' : ''}} disabled>{{ __('all-course.teacher') }}</option>
                        @foreach ($teachers as $key => $teacher)
                            <option {{ (isset($data['teacher']) && in_array($teacher->id, $data['teacher'])) ? 'selected' : ''}} value="{{ $teacher->id }}">
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                      </select>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</form>
    <div class="list-course">
        <div id="countryList">
            @if( $courses->count() == 0)
                <div class="no-course">
                    <div class="no-course-icon"><i class="fa-solid fa-sad-tear"></i></div>
                    <div class="no-course-text">{{ __('all-course.no_course') }}</div>
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
                                {{ $course->learners }}
                            </div>
                        </div>
                        <div class="course-statics-items">
                            <div class="title">
                                Lessons
                            </div>
                            <div class="statics">
                                {{ $course->lessons }}
                            </div>
                        </div>
                        <div class="course-statics-items">
                            <div class="title">
                                Times
                            </div>
                            <div class="statics">
                                {{ round(($course->times) / 3600) }} {{ __('all-course.hour') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $courses->appends(request()->query())->links() }}
        </div>
        <div class="clear"></div>
    </div>
</div>
@endsection
