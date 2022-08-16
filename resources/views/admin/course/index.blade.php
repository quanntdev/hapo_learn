@extends('admin.layouts.app')

@section('admin-content')

<div class="container">
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
<div class="container">
  <div class="gruop-filter mt-5">
    <div class="gruop-search">
        <form role="search" method="GET" action="{{ route('course.index') }}">
            <input type="text"
                placeholder="{{ __('course.input_placeholder') }}"
                name="keyword" id="search_input"
                @if( !empty($data['keyword']) ) value="{{ $data['keyword'] }}" @endif>
            <div class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <button class="btn btn-search" type="submit">{{ __('course.input_placeholder') }}</button>
    </div>
</div>
<div class="box-filter active ">
    <div class="row">
        <div class="col-1 title">{{ __('course.sort_by') }}</div>
        <div class="col-11">
            <div class="btn-option">
                    <div class="inputGroup">
                        <input id="radio1"
                                name="created_time"
                                @if ( !isset($data['created_time']) || $data['created_time'] ==  config('course.high_to_low') || $data['lastest'] = '' ) checked  @endif type="radio"
                                value="{{ config('course.high_to_low') }}"/>
                        <label for="radio1">{{ __('course.last_est') }}</label>
                    </div>
            </div>
            <div class="btn-option" >
                <div class="inputGroup">
                    <input id="radio2"
                            name="created_time"
                            type="radio"
                            @if ((isset($data['created_time']) && $data['created_time'] != config('course.high_to_low'))) checked @endif
                            value="{{ config('course.low_to_high') }}"/>
                    <label for="radio2">{{ __('course.old_est') }}</label>
                </div>
            </div>
            <div class="btn-option">
                <select name="learners" class="sort" id="sort-student">
                    <option value="">{{__('course.number_student')}}</option>
                    <option {{ (isset($data['learners']) && $data['learners'] == config('course.low_to_high')) ? 'selected' : '' }}
                            value="{{ config('course.low_to_high') }}">
                            {{ __('course.ascending') }}
                    </option>
                    <option {{ (isset($data['learners']) && $data['learners'] == config('course.high_to_low')) ? 'selected' : '' }}
                            value="{{ config('course.high_to_low') }}">
                            {{ __('course.descending') }}
                    </option>
                </select>
            </div>
            <div class="btn-option">
                <select name="time" class="sort" id="sort-time">
                    <option value="">{{ __('course.time') }}</option>
                    <option {{ (isset($data['time']) && $data['time'] == config('course.low_to_high')) ? 'selected' : '' }}
                        value="{{ config('course.low_to_high') }}">
                        {{ __('course.ascending') }}
                    </option>
                    <option {{ (isset($data['time']) && $data['time'] == config('course.high_to_low')) ? 'selected' : '' }}
                        value="{{ config('course.high_to_low') }}">
                        {{ __('course.descending') }}
                    </option>
                </select>
            </div>
            <div class="btn-option">
                <select name="lesson" id="sort-lesson" class="sort">
                    <option value="">{{__('course.number_lesson')}}</option>
                    <option {{ (isset($data['lesson']) && $data['lesson'] == config('course.low_to_high')) ? 'selected' : '' }}
                        value="{{ config('course.low_to_high') }}">
                        {{ __('course.most') }}
                    </option>
                    <option {{ (isset($data['lesson']) && $data['lesson'] == config('course.high_to_low')) ? 'selected' : '' }}
                         value="{{ config('course.high_to_low') }}">
                         {{ __('course.least') }}
                    </option>
                </select>
            </div>
            <div class="btn-option">
                <select name="comment" id="sort-comment" class="sort">
                    <option value="">{{__('course.review')}}</option>
                    <option {{ (isset($data['comment']) && $data['comment'] == config('course.low_to_high')) ? 'selected' : '' }}
                         value="{{ config('course.low_to_high') }}">
                         {{ __('course.ascending') }}
                    </option>
                    <option {{ (isset($data['comment']) && $data['comment'] == config('course.high_to_low')) ? 'selected' : '' }}
                        value="{{ config('course.high_to_low') }}">
                        {{ __('course.descending') }}
                    </option>
                </select>
            </div>
            <div class="btn-option">
                <select class="form-control col-12 js-example-basic-single select" name="tags[]" multiple>
                    <option value="" {{ (!isset($data['tags'])) ? 'selected' : ''}} disabled>{{__('course.tags')}}</option>
                    @foreach ($tags as $key => $tag)
                        <option  {{ (isset($data['tags']) && in_array($tag->id, $data['tags'])) ? 'selected' : ''}} value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="btn-option">
                <select class="form-control col-12 js-example-basic-single select" name="teacher[]" multiple>
                    <option value="" {{ (!isset($data['teacher'])) ? 'selected' : ''}} disabled>{{ __('course.teacher') }}</option>
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
    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                <div class="card-header">Show all Courses</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      <table class="table table-dark  table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Course's Name</th>
                              <th scope="col">Slug Course</th>
                              <th scope="col">Image</th>
                              <th scope="col">Price</th>
                              <th scope="col">Status</th>
                              <th scope="col">Manager</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($courses as $key => $course)
                            <tr>
                              <th scope="row">{{ $key+1 }}</th>
                              <td>{{ $course->course_name }}</td>
                              <td>{{ $course->slug_course }}</td>
                              <td>
                                <img src="{{ asset($course->image) }}" alt="" style="width: 300px; height:150px; object-fit:cover">
                              </td>
                              <td> {{ $course->prices }} </td>
                              <td>
                                @if($course->status == config('tag.status'))
                                <p class="text-success">Active</p>
                                @else
                                <p class="text-danger">Not Active</p>
                                @endif
                              </td>
                              <td>
                                    <div class="d-flex">
                                    <a href="{{route('course.show', [$course->slug_course])}} " class="btn btn-primary ">Show</a>
                                    <a href="{{route('course.edit', [$course->id])}}" class="btn btn-warning ms-2">Edit</a>
                                    <form action="{{route('course.destroy',[$course->id])}}" method ="POST">
                                      @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger ms-2" onclick="return confirm('Do you want to delete this Course')">Delete</button>
                                    </form>
                                </div>
                              </td>
                            </tr>
                            <div class="clear"></div>
                            @endforeach
                          </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
