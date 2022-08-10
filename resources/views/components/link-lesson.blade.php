<div class="link-lesson">
    @if (($course->isJoined || $course->isFinished) && !$lesson->IsFinished())
    <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn-start-learn"> {{ __('course-detail.link_lesson') }} </a>
    @elseif ($lesson->IsFinished() )
    <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn btn-success"> complete </a>
    @else
    <div class="cant-learn"> {{ __('course-detail.link_lesson') }} </div>
    @endif
</div>
