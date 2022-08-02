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
             {{ round(($course->times) / 3600) }} {{ __('course-detail.time_value') }}
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
            @if($course->price == 0)
            {{ __('course-detail.free') }}
            @else
            : {{ number_format($course->price) }} {{ __('course-detail.price_value') }}
            @endif
        </div>
    </div>
    @if ($course->isJoined && $course->isFinished == 0)
        <form action="{{ route('course-users.update',[$course->id]) }}" method="POST" class="form-end-course">
            @method('PUT')
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
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