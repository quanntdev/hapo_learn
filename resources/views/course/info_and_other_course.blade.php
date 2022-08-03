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
            {{ $course->checkPrice }}
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
@include('course.other_course')
