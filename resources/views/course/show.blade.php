@extends('layouts.app')

@section('content')

<div class="container course-detail">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}" class="breadcrumb-link">Home</a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="{{ route('course.index') }}" class="breadcrumb-link">All Course</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $course->course_name }}</li>
        </ol>
    </nav>
</div>
@if (session('join'))
    <div class="toast toast-profile" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
        <div class="toast-header">
            <strong class="me-auto">HapoLearn</strong>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="getElementById('toast').classList.toggle('none')"></button>
        </div>
        <div class="toast-body text-success">
            {{ session('join') }}
        </div>
    </div>
@endif
@if (session('success_lesson'))
    <div class="toast toast-profile" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
        <div class="toast-header">
            <strong class="me-auto">HapoLearn</strong>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="getElementById('toast').classList.toggle('none')"></button>
        </div>
        <div class="toast-body text-success">
            {{ session('success_lesson') }}
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
        <div class="row">
            <div class="col-8 mt-4 body-show-course">
                <div class="course-image">
                    <img src="{{ asset($course->image) }}" alt="">
                </div>
                <div class="course-lesson">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab @if (empty(session('success')) && empty($error)) active  @endif" id="lesson-tab" data-bs-toggle="tab" data-bs-target="#lesson-tab-pane" type="button" role="tab" aria-controls="lesson-tab-pane" aria-selected="true">{{ __('course-detail.lessons') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab" id="teacher-tab" data-bs-toggle="tab" data-bs-target="#teacher-tab-pane" type="button" role="tab" aria-controls="teacher-tab-pane" aria-selected="false">{{ __('course-detail.teacher') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab @if (session('success')) active  @elseif(isset($error)) active @endif) " id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane" type="button" role="tab" aria-controls="review-tab-pane" aria-selected="false">{{ __('course-detail.reviews') }}</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade @if (empty(session('success')) && empty($error)) show active  @endif" id="lesson-tab-pane" role="tabpanel" aria-labelledby="lesson-tab" tabindex="0">
                            <div class="gruop-search">
                                <form role="search" method="GET" action="{{ route('course.show', [$course->slug_course]), }}">
                                    <input type="text"
                                        placeholder="{{ __('course.input_placeholder') }}"
                                        name="search" id="search_input"  @if( !empty($data['search']) ) value="{{ $data['search'] }}" @endif>
                                        <div class="search-icon">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                    <button class="btn btn-search"
                                            type="submit" name="submit">{{ __('course.input_placeholder') }}</button>
                                </form>
                                @can('view', auth()->user())
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    {{ __('Create Lesson') }}
                                  </button>
                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 900px">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">{{ __('Create Lesson') }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          @include('components.course.create-lesson')
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endcan

                                @cannot ('view', auth()->user())
                                @include('components.course.join-course-form')
                                @endcannot
                            </div>
                            <div class="list-lesson">
                                @foreach ($lessons as $key => $lesson)
                                <div class="lesson-items">
                                    <div class="number-lesson">{{ (isset($data['page'])) ? $key + ($data['page'] - 1) * config('course.lesson_paginate') + 1 : $key + 1 }}.</div>
                                    <div class="name-lesson">
                                        <div class="content">
                                             {{ $lesson->name_lesson }}
                                             @can('view', auth()->user())
                                             @if ($lesson->status == config('course.onstatus'))
                                                <a class="text-success">( Active )</a>
                                            @else
                                                <a class="text-danger">( NotActive )</a>
                                            @endif
                                            @endcan
                                        </div>
                                    </div>
                                    @cannot ('view', auth()->user())
                                    @include('components.course.link-lesson')
                                    @endcannot
                                    @can ('view', auth()->user())
                                    <div class="d-flex">
                                        <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn btn-success"> {{ __('View') }} </a>
                                             <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$lesson->id}}">
                                                Edit
                                        </button>
                                        <div class="modal fade" id="exampleModal{{$lesson->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$lesson->id}}" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 900px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Lesson :') . $lesson->name_lesson }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                <div class="modal-body">
                                                    @include('components.lesson.edit-lesson-form')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{route('lessons.destroy',[$lesson->id])}}" method ="POST">
                                        @method('DELETE')
                                          @csrf
                                          <button class="btn btn-danger ms-2" onclick="return confirm('Do you want to delete this Lesson')">Delete</button>
                                      </form>
                                    </div>
                                    @endcan
                                </div>
                                <div class="clear"></div>
                                @endforeach
                                @if ($lessons->count() > 0)
                                    @if (((isset($data['page']) && $data['page'] > 0) || empty($data['page'])) && $lessons[$lessons->count() - 1 ]->IsFinished())
                                        {{ $lessons->appends(request()->query())->appends(['learned' => 'true'])->links() }}
                                    @else
                                        {{ $lessons->appends(request()->query())->links() }}
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="teacher-tab-pane" role="tabpanel" aria-labelledby="teacher-tab" tabindex="0">
                            <div class="main-review">
                                <div class="title"> {{ __('course-detail.main_teacher') }} </div>
                                @foreach ($teachers as $key => $teacher)
                                <div class="list-teacher">
                                    <div class="group-avatar">
                                        <img class="avatar" src="{{ $teacher->CheckAvatar }}" alt="">
                                        <div class="info">
                                            <div class="name">{{ $teacher->name }}</div>
                                            <div class="year">{{ $teacher->created_at->diffForHumans(null, true)." ".__('course-detail.teacher') }}</div>
                                        </div>
                                    </div>
                                    <div class="about-teacher">
                                        {{ $teacher->about_me }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade @if (session('success')) show active  @elseif(isset($error)) show active @endif" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab" tabindex="0">
                            <div class="main-reviews">
                                <div class="title">
                                    {{ $comments->count() }} {{ __('course-detail.reviews') }}
                                </div>
                                <div class="view-vote">
                                    <div class="all-star-vote">
                                        <div class="point">{{ $course->rates }}</div>
                                        <div class="star">
                                            @for ($i = 0; $i < $course->rates; $i++)
                                                <span class="fa fa-star checked"></span>
                                            @endfor
                                        </div>
                                        <div class="number-vote">
                                            {{ $course->countRates }} {{ __('course-detail.rating') }}
                                        </div>
                                    </div>
                                    <div class="see-star-vote">
                                        <div class="side">
                                            <div>5 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                              <div class="bar-status" style="width: {{  $course->countRates >0 ? ($course->countRates5 / $course->countRates) * 100 : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $course->countRates5 }} </div>
                                        </div>
                                        <div class="side">
                                            <div>4 star</div>
                                        </div>
                                        <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-status" style="width: {{ $course->countRates >0 ? ($course->countRates4 / $course->countRates) * 100 : 0 }}%"></div>
                                        </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $course->countRates4 }} </div>
                                        </div>
                                        <div class="side">
                                            <div>3 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-status" style="width: {{  $course->countRates >0 ? ($course->countRates3 / $course->countRates) * 100 : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $course->countRates3 }} </div>
                                        </div>
                                        <div class="side">
                                            <div>2 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-status" style="width: {{  $course->countRates >0 ? ($course->countRates2 / $course->countRates) * 100 : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $course->countRates2 }} </div>
                                        </div>
                                        <div class="side">
                                            <div>1 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-status" style="width: {{  $course->countRates >0 ? ($course->countRates1 / $course->countRates) * 100 : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $course->countRates1 }} </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="show-review">
                                    <div class="title"> {{ __('course-detail.show_all_review') }} </div>
                                    @foreach ($comments as $key => $comment)
                                    <div class="user-review">
                                        @if ($comment->user->id ==auth ()->id())
                                        <button class="edit-button" onclick="getElementById('comemnt{{$comment->id}}').classList.toggle('none'); getElementById('edit{{$comment->id}}').classList.toggle('block')"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <div class="clear"></div>
                                        @endif
                                        <div class="user">
                                            <div class="avatar">
                                                <img src=" {{ asset($comment->user->CheckAvatar) }} " alt="">
                                            </div>
                                            <div class="name">
                                                {{ $comment->user->name }}
                                            </div>
                                            <div class="rating">
                                                @for ($i = 0; $i < $comment->star; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                @for ($i = $comment->star; $i < 5; $i++)
                                                    <span class="fa fa-star"></span>
                                                @endfor
                                            </div>
                                            <div class="time-coment">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="content" id="comemnt{{$comment->id}}">
                                            {{ $comment->comment }}
                                        </div>
                                        <div class="box-edit" id="edit{{$comment->id}}">
                                            <div class="form-comment">
                                                <form action="{{ route('comments.update',[$comment->id]) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-floating">
                                                        <textarea class="form-control comment-input" placeholder="Leave a comment here" id="floatingTextarea" rows="10" name="comment">{{ $comment->comment }}</textarea>
                                                        <label for="floatingTextarea">Comments</label>
                                                    </div>
                                                    <div class="form-vote">
                                                        <div class="vote-title">
                                                            {{ __('course-detail.vote') }}
                                                        </div>
                                                            <div class="stars2">
                                                                <input class="star star-5" @if($comment->star == 5) checked @endif id="star-5edit{{$comment->id}}" type="radio" name="star" value="5"/>
                                                                <label class="star star-5"  for="star-5edit{{$comment->id}}"></label>
                                                                <input class="star star-4" @if($comment->star == 4) checked @endif id="star-4edit{{$comment->id}}" type="radio" name="star" value="4"/>
                                                                <label class="star star-4" for="star-4edit{{$comment->id}}"></label>
                                                                <input class="star star-3" @if($comment->star == 3) checked @endif id="star-3edit{{$comment->id}}" type="radio" name="star" value="3"/>
                                                                <label class="star star-3" for="star-3edit{{$comment->id}}"></label>
                                                                <input class="star star-2" @if($comment->star == 2) checked @endif id="star-2edit{{$comment->id}}" type="radio" name="star" value="2"/>
                                                                <label class="star star-2" for="star-2edit{{$comment->id}}"></label>
                                                                <input class="star star-1" @if($comment->star == 1) checked @endif id="star-1edit{{$comment->id}}" type="radio" name="star" value="1"/>
                                                                <label class="star star-1" for="star-1edit{{$comment->id}}"></label>
                                                            </div>
                                                    </div>
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <div class="btn-comment">
                                                        <button type="submit"> {{__('course-detail.send') }} </button>
                                                    </div>
                                                    <div class="clear"></div>
                                                </form>
                                            </div>
                                        </div>
                                        @if ($comment->user->id ==auth ()->id())
                                        <div class="box-delete">
                                            <form action="{{route('comments.destroy',[$comment->id])}}" method ="POST">
                                      @method('DELETE')
                                        @csrf
                                        <button class="edit-button" onclick="return confirm('Do you want to delete this Comment')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                        </div>
                                        @endif
                                        @if (auth()->user())
                                        <div class="accordion-item button-reply-items">
                                            <h2 class="accordion-header" id="flush-heading{{$comment->id}}">
                                              <button class="accordion-button collapsed button-reply" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$comment->id}}" aria-expanded="false" aria-controls="flush-collapse{{$comment->id}}" onclick="getElementById('replys{{$comment->id}}').classList.toggle('block')">
                                                {{ __('course-detail.add_your_reply') }}
                                              </button>
                                            </h2>
                                            <div id="replys{{$comment->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$comment->id}}" data-bs-parent="#accordionFlushExample">
                                              <div class="accordion-body">
                                                <div class="form-comment form-reply">
                                                    <form action="{{ route('comments.store') }}" method="POST">
                                                        @csrf
                                                        <div class="form-floating">
                                                            <textarea class="form-control comment-input" placeholder="Leave a comment here" id="floatingTextarea" rows="10" name="comment"></textarea>
                                                            <label for="floatingTextarea">Comments</label>
                                                        </div>
                                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                        <div class="btn-comment btn-reply">
                                                            <button type="submit"> {{__('course-detail.send') }} </button>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="user-reply">
                                            @foreach ($replys as $key => $reply)
                                                @if($reply->parent_id == $comment->id)
                                                <div class="user-review">
                                                    @if ($reply->user->id == auth()->id())
                                                        <button class="edit-button" onclick="getElementById('reply{{$reply->id}}').classList.toggle('none'); getElementById('editReply{{$reply->id}}').classList.toggle('block')"><i class="fa-solid fa-pen-to-square"></i></button>
                                                        <div class="clear"></div>
                                                     @endif
                                                    <div class="user">
                                                        <div class="avatar">
                                                            <img src=" {{ asset($reply->user->checkAvatar) }} " alt="">
                                                        </div>
                                                        <div class="name">
                                                            {{ $reply->user->name }}
                                                        </div>
                                                        <div class="time-coment">
                                                            {{ $reply->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                    <div class="box-edit" id="editReply{{$reply->id}}">
                                                        <div class="form-comment">
                                                            <form action="{{ route('comments.update',[$reply->id]) }}" method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="form-floating">
                                                                    <textarea class="form-control comment-input" placeholder="Leave a comment here" id="floatingTextarea" rows="10" name="comment">{{ $reply->comment }}</textarea>
                                                                    <label for="floatingTextarea">Comments</label>
                                                                    @error('comment')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-vote">
                                                                </div>
                                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                                <div class="btn-comment">
                                                                    <button type="submit"> {{__('course-detail.send') }} </button>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="content" id="reply{{$reply->id}}">
                                                        {{ $reply->comment }}
                                                    </div>
                                                </div>
                                                @if ($reply->parent_id == $comment->id)
                                                @if ($reply->user->id == auth()->id())
                                        <div class="box-delete me-1">
                                            <form action="{{route('comments.destroy',[$reply->id])}}" method ="POST">
                                      @method('DELETE')
                                        @csrf
                                        <button class="edit-button me-4" onclick="return confirm('Do you want to delete this Comment')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                        </div>
                                        @endif
                                        @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="your-comment">
                                    <div class="title">
                                        {{ __('course-detail.your_review') }}
                                    </div>
                                    @if ($course->isCommented && auth()->user() && $course->isJoined)
                                        <div class="btn btn-danger">{{ __('You have already rated this course') }}</div>
                                    @elseif (auth()->user() && $course->isJoined)
                                    <div class="form-comment">
                                        <div class="title">
                                            {{ __('course-detail.message') }}
                                        </div>
                                        @cannot('view', auth()->user())
                                        <form action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            <div class="form-floating">
                                                <textarea class="form-control comment-input" placeholder="Leave a comment here" id="floatingTextarea" rows="10" name="comment"></textarea>
                                                <label for="floatingTextarea">Comments</label>
                                                @error('comment')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-vote">
                                                <div class="vote-title">
                                                    {{ __('course-detail.vote') }}
                                                </div>
                                                    <div class="stars">
                                                        <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                                                        <label class="star star-5" for="star-5"></label>
                                                        <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                                        <label class="star star-4" for="star-4"></label>
                                                        <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                                                        <label class="star star-3" for="star-3"></label>
                                                        <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                                                        <label class="star star-2" for="star-2"></label>
                                                        <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                                                        <label class="star star-1" for="star-1"></label>
                                                    </div>
                                            </div>
                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                            <div class="btn-comment">
                                                <button type="submit"> {{__('course-detail.send') }} </button>
                                            </div>
                                            <div class="clear"></div>
                                        </form>
                                        @endcannot
                                    </div>
                                    @elseif (auth()->user() && !$course->isJoined)
                                    <form action="{{ route('course-users.store') }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                            <button class="add-course-comment" type="submit">{{ __('course-detail.add_course') }}</button>
                                    </form>
                                    @else
                                    <div class="must-login">
                                        <a href="{{ route('login') }}">{{ __('course-detail.must_comment') }}</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
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
                <div class="info">
                    <div class="info-items">
                        <div class="icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="title">
                            {{ __('course-detail.learner') }}
                        </div>
                        <div class="content">
                            : {{ $course->learners }}
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="info-items">
                        <div class="icon">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <div class="title">
                            {{ __('course-detail.lessons') }}
                        </div>
                        <div class="content">
                            : {{ $course->lessons }} {{ __('course-detail.lesson_value') }}
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
                            : {{ $course->times }} {{ __('course-detail.time_value') }}
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
                            : {{ $course->prices }}
                        </div>
                    </div>
                    @cannot ('view', auth()->user())
                    @if ($course->isnotFinished)
                    <form action="{{ route('course-users.update',[$course->id]) }}" method="POST" class="form-end-course">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <button class="button-end-course" onclick="return confirm('Do you want to finish this?')" type="submit">{{ __('course-detail.end_course') }}</button>
                    </form>
                @endif
                    @endcannot
                </div>
                @include('components.course.other-course')
            </div>
        </div>
    </div>
</div>
@endsection
