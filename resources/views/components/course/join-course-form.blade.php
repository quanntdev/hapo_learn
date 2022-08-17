<form action="{{ route('course-users.store') }}" method="POST" class="btn-join-course">
    @csrf
    @if (!$course->isJoined)
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <button class="add-course" type="submit">{{ __('course-detail.add_course') }}</button>
    @elseif (!$course->isFinished)
        <div class="btn btn-success text-light"> {{__('course-detail.on_learn')}} </div>
    @elseif ($course->isFinished)
        <div class="btn btn-danger text-light"> {{__('course-detail.finish_learn')}} </div>
    @else
        <a href="{{ route('login') }}" class="login-course">{{ __('course-detail.must_login_learn') }}</a>
    @endif
</form>
