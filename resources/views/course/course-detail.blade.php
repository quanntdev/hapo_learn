@extends('layouts.app')

@section('content')

@php
    $rate = round($courses->rates / $comments->count());
@endphp

<div class="container course-detail">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}" class="breadcrumb-link">Home</a></li>
          <li class="breadcrumb-item" aria-current="page"><a href="{{ route('course.index') }}" class="breadcrumb-link">All Course</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $courses->course_name }}</li>
        </ol>
    </nav>
</div>

<div class="course-detail-body">
    <div class="course-detail-container">
        <div class="row ">
            <div class="col-8 mt-4">
                <div class="course-image">
                    <img src="{{ $courses->image }}" alt="">
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
                                <form role="search" method="GET" action="{{ route('course.show', [$courses->slug_course]), }}">
                                    <input type="text"
                                        placeholder="{{ __('course.input_placeholder') }}"
                                        name="search" id="search_input"  @if( !empty($data['search']) ) value="{{ $data['search'] }}" @endif>
                                        <div class="search-icon">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </div>
                                    <button class="btn btn-search"
                                            type="submit" name="submit">{{ __('course.input_placeholder') }}</button>
                                </form>
                                <form action="{{ route('course-user.store') }}" method="POST">
                                    @csrf
                                    @if (!$courses->joined)
                                        <input type="hidden" name="course_id" value="{{ $courses->id }}">
                                        <button class="add-course" type="submit">{{ __('course-detail.add_course') }}</button>
                                    @elseif ($courses->joined && $courses->finished == 0)
                                        <div class="btn btn-success text-light"> {{__('course-detail.on_learn')}} </div>
                                    @elseif ($courses->joined && $courses->finished != 0)
                                        <div class="btn btn-danger text-light"> {{__('course-detail.finish_learn')}} </div>
                                    @else
                                        <a href="{{ route('login') }}" class="login-course">{{ __('course-detail.must_login_learn') }}</a>
                                    @endif
                                </form>
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
                                    <div class="link-lesson">
                                        @if ($courses->joined)
                                        <a href="#"> {{ __('course-detail.link_lesson') }} </a>
                                        @else
                                        <div class="cant-learn"> {{ __('course-detail.link_lesson') }} </div>
                                        @endif
                                    </div>
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
                                        <div class="point">{{ $rate }}</div>
                                        <div class="star">
                                            @for ($i = 0; $i < $rate; $i++)
                                                <span class="fa fa-star checked"></span>
                                            @endfor
                                        </div>
                                        <div class="number-vote">
                                            {{ $courses->countRates }} {{ __('course-detail.rating') }}
                                        </div>
                                    </div>
                                    <div class="see-star-vote">
                                        <div class="side">
                                            <div>5 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                              <div class="bar-status" style="width: {{ ($courses->countRates5 / $courses->countRates)*100 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $courses->countRates5 }} </div>
                                        </div>
                                        <div class="side">
                                            <div>4 star</div>
                                        </div>
                                        <div class="middle">
                                        <div class="bar-container">
                                            <div class="bar-status" style="width: {{ ($courses->countRates4 / $courses->countRates)*100 }}%"></div>
                                        </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $courses->countRates4 }} </div>
                                        </div>
                                        <div class="side">
                                            <div>3 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-status" style="width: {{ ($courses->countRates3 / $courses->countRates)*100 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $courses->countRates3 }} </div>
                                        </div>
                                        <div class="side">
                                            <div>2 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-status" style="width: {{ ($courses->countRates2 / $courses->countRates)*100 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $courses->countRates2 }} </div>
                                        </div>
                                        <div class="side">
                                            <div>1 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-status" style="width: {{ ($courses->countRates1 / $courses->countRates)*100 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div> {{ $courses->countRates1 }} </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="show-review">
                                    <div class="title"> {{ __('course-detail.show_all_review') }} </div>
                                    @foreach ($comments as $key => $comment)
                                    <div class="user-review">
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
                                        <div class="content">
                                            {{ $comment->comment }}
                                        </div>
                                        @if (Auth::user())
                                        <div class="accordion-item button-reply-items">
                                            <h2 class="accordion-header" id="flush-heading{{$comment->id}}">
                                              <button class="accordion-button collapsed button-reply" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$comment->id}}" aria-expanded="false" aria-controls="flush-collapse{{$comment->id}}">
                                                {{ __('course-detail.add_your_reply') }}
                                              </button>
                                            </h2>
                                            <div id="flush-collapse{{$comment->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$comment->id}}" data-bs-parent="#accordionFlushExample">
                                              <div class="accordion-body">
                                                <div class="form-comment form-reply">
                                                    <form action="{{ route('reply.store') }}" method="POST">
                                                        @csrf
                                                        <div class="form-floating">
                                                            <textarea class="form-control comment-input" placeholder="Leave a comment here" id="floatingTextarea" rows="10" name="comment"></textarea>
                                                            <label for="floatingTextarea">Comments</label>
                                                        </div>
                                                        <input type="hidden" name="course_id" value="{{ $courses->id }}">
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
                                                    <div class="content">
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
                                    @if (Auth::user())
                                    <div class="form-comment">
                                        <div class="title">
                                            {{ __('course-detail.message') }}
                                        </div>
                                        <form action="{{ route('comment.store') }}" method="POST">
                                            @csrf
                                            <div class="form-floating">
                                                <textarea class="form-control comment-input" placeholder="Leave a comment here" id="floatingTextarea" rows="10" name="comment"></textarea>
                                                <label for="floatingTextarea">Comments</label>
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
                                            <input type="hidden" name="course_id" value="{{ $courses->id }}">
                                            <div class="btn-comment">
                                                <button type="submit"> {{__('course-detail.send') }} </button>
                                            </div>
                                            <div class="clear"></div>
                                        </form>
                                    </div>
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
                        {{ $courses->description }}
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
                            : {{ $courses->learners }}
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
                            : {{ $courses->lessons }} {{ __('course-detail.lesson_value') }}
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
                             {{ round(($courses->times) / 3600) }} {{ __('course-detail.time_value') }}
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

                            <a href="">#{{ $tag->tag_name }}</a>,

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
                            @if($courses->price == 0)
                            {{ __('course-detail.free') }}
                            @else
                            : {{ number_format($courses->price) }} {{ __('course-detail.price_value') }}
                            @endif
                        </div>
                    </div>
                    @if ($courses->joined && $courses->finished == 0)
                        <form action="{{ route('course-user.update',[$courses->id]) }}" method="POST" class="form-end-course">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $courses->id }}">
                            <button class="button-end-course" type="submit">{{ __('course-detail.end_course') }}</button>
                        </form>
                    @endif

                </div>
                <div class="other-course">
                    <div class="title">
                        {{ __('course-detail.other_courses') }}
                    </div>
                    <div class="list-course-other">
                        @foreach ($otherCourses as $key => $otherCourse)
                        <div class="course-items">
                            <div class="number">{{ $key + 1 }}.</div>
                            <div class="content"><a href="{{ $otherCourse->slug_course }}">{{ $otherCourse->course_name }}</a></div>
                        </div>
                        @endforeach
                    </div>
                    <div class="view-all-courses">
                        <a href="">{{ __('course-detail.view_all_course') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection