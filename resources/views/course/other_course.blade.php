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
