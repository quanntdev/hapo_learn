@if (!$lesson->IsJoined())
    <form action="{{ route('user-lesson.store') }}" class="start-learn-lesson" method="POST">
        @csrf
        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
        <button type="submit">Start Learn Lesson</button>
        <div class="clear"></div>
    </form>
@elseif($lesson->IsFinished())
    <div class="btn btn-danger btn-lesson-learned">You have finish this lesson</div>
    <div class="clear"></div>
@else
    <div class="btn btn-success btn-lesson-learned">You have learn this lesson</div>
    <div class="clear"></div>
@endif
