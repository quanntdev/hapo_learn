<div class="link">
    @if ($lesson->IsJoined())
        @if (!$program->isLearned())
            <form action="{{ route('user-program.store') }}" method="POST">
                 @csrf
                <input type="hidden" name="program_id" value="{{ $program->id }}">
                <button class="button-link">preview</button>
            </form>
        @else
            <div class="have-join btn btn-success">
                Complete
            </div>
        @endif
    @endif
</div>