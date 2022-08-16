<div class="link">
    @if ($lesson->IsJoined())
        @if (!$program->isLearned())
            <form action="{{ route('user-program.store') }}" method="POST">
                 @csrf
                <input type="hidden" name="program_id" value="{{ $program->id }}">
                <button class="button-link" type="submit" onclick="openLink('{{$program->file}}')">preview</button>
            </form>
        @else
            <a href="" class="have-join btn btn-success">
                Complete
            </a>
        @endif
    @endif
</div>
