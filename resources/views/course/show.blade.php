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

<div class="course-detail-body">
    <div class="course-detail-container">
        <div class="row ">
            <div class="col-8 mt-4">
                <div class="course-image">
                    <img src="{{ $course->image }}" alt="">
                </div>
                <div class="course-lesson">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab @if (empty(session('success'))) active  @endif" id="lesson-tab" data-bs-toggle="tab" data-bs-target="#lesson-tab-pane" type="button" role="tab" aria-controls="lesson-tab-pane" aria-selected="true">{{ __('course-detail.lessons') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab" id="teacher-tab" data-bs-toggle="tab" data-bs-target="#teacher-tab-pane" type="button" role="tab" aria-controls="teacher-tab-pane" aria-selected="false">{{ __('course-detail.teacher') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link view-tab @if (session('success')) active  @endif" id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane" type="button" role="tab" aria-controls="review-tab-pane" aria-selected="false">{{ __('course-detail.reviews') }}</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade @if (empty(session('success'))) show active  @endif" id="lesson-tab-pane" role="tabpanel" aria-labelledby="lesson-tab" tabindex="0">
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
                                @include('components.course.join-course-form')
                            </div>
                            <div class="list-lesson">
                                @foreach ($lessons as $key => $lesson)
                                <div class="lesson-items">
                                    <div class="number-lesson">{{ $key+1 }}.</div>
                                    <div class="name-lesson">
                                        <div class="content">
                                             {{ $lesson->name_lesson }}
                                        </div>
                                    </div>
                                    @include('components.course.link-lesson')
                                </div>
                                @endforeach
                                {{ $lessons->appends(request()->query())->links() }}
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="teacher-tab-pane" role="tabpanel" aria-labelledby="teacher-tab" tabindex="0">
                            <div class="main-review">
                                <div class="title"> {{ __('course-detail.main_teacher') }} </div>
                                @foreach ($teachers as $key => $teacher)
                                <div class="list-teacher">
                                    <div class="group-avatar">
                                        <img class="avatar" src="{{ $teacher->avatar }}" alt="">
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
                        <div class="tab-pane fade @if (session('success')) show active  @endif" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab" tabindex="0">
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
                                                <img src=" {{ $comment->user->avatar }} " alt="">
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
                                        @if (auth()->user())
                                        <div class="accordion-item button-reply-items">
                                            <h2 class="accordion-header" id="flush-heading{{$comment->id}}">
                                              <button class="accordion-button collapsed button-reply" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$comment->id}}" aria-expanded="false" aria-controls="flush-collapse{{$comment->id}}">
                                                {{ __('course-detail.add_your_reply') }}
                                              </button>
                                            </h2>
                                            <div id="flush-collapse{{$comment->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$comment->id}}" data-bs-parent="#accordionFlushExample">
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
                                                    @if ($reply->user->id ==auth()->id())
                                                        <button class="edit-button" onclick="getElementById('reply{{$reply->id}}').classList.toggle('none'); getElementById('editReply{{$reply->id}}').classList.toggle('block')"><i class="fa-solid fa-pen-to-square"></i></button>
                                                        <div class="clear"></div>
                                                     @endif
                                                    <div class="user">
                                                        <div class="avatar">
                                                            <img src=" {{ $reply->user->avatar }} " alt="">
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
                                    @if (auth()->user() && $course->isJoined)
                                    <div class="form-comment">
                                        <div class="title">
                                            {{ __('course-detail.message') }}
                                        </div>
                                        <form action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            <div class="form-floating">
                                                <textarea class="form-control comment-input" placeholder="Leave a comment here" id="floatingTextarea" rows="10" name="comment"></textarea>
                                                <label for="floatingTextarea">Comments</label>
                                                @error('comment')
                                                    <span class="invalid-feedback" role="alert">
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
                             {{ $course->times }} {{ __('course-detail.time_value') }}
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
                            {{ $course->prices }}
                        </div>
                    </div>
                    @if ($course->isnotFinished)
                        <form action="{{ route('course-users.update',[$course->id]) }}" method="POST" class="form-end-course">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
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
