<div class="link-lesson">
    @if($key + ( (isset($data['page']) ? $data['page'] : 1) -1) * config('course.lesson_paginate') == 0 )
        @if (($course->isJoined || $course->isFinished) && !$lesson->IsFinished())
            <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn-start-learn"> {{ __('course-detail.link_lesson') }} </a>
        @elseif ($lesson->IsFinished())
            <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn btn-success"> complete </a>
        @else
            <div class="cant-learn"> {{ __('course-detail.link_lesson') }} </div>
        @endif
    @elseif ($key + ( (isset($data['page']) ? $data['page'] : 1) -1) * config('course.lesson_paginate') > 0 && $key + ( (isset($data['page']) ? $data['page'] : 1) -1) * config('course.lesson_paginate') < config('course.lesson_paginate') )
        @if (($course->isJoined || $course->isFinished) && !$lesson->IsFinished() && ($lessons[$key + ( (isset($data['page']) ? $data['page'] : 1) -1) * config('course.lesson_paginate') - 1]->IsFinished()))
            <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn-start-learn"> {{ __('course-detail.link_lesson') }} </a>
        @elseif ($lesson->IsFinished())
            <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn btn-success"> complete </a>
        @else
            <div class="cant-learn"> {{ __('course-detail.link_lesson') }} </div>
        @endif
    @else
        @if (isset($data['learned']))
            @if ($key == 0)
                @if (!$lesson->IsFinished())
                    <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn-start-learn"> {{ __('course-detail.link_lesson') }} </a>
                @else
                    <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn btn-success"> complete </a>
                @endif
            @elseif ($key > 0)
                @if (!$lesson->IsFinished() && ($lessons[$key - 1]->IsFinished()))
                    <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn-start-learn"> {{ __('course-detail.link_lesson') }} </a>
                @elseif ($lesson->IsFinished())
                    <a href="{{ route('lessons.show', [$lesson->slug_lesson]) }}" class="btn btn-success"> complete </a>
                @else
                    <div class="cant-learn"> {{ __('course-detail.link_lesson') }} </div>
                @endif
            @endif
        @else
            <div class="cant-learn"> {{ __('course-detail.link_lesson') }} </div>
        @endif
    @endif
</div>
