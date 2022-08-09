<div class="course-lesson">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link view-tab  @if (!session('success')) active  @endif" id="descriptions-tab" data-bs-toggle="tab" data-bs-target="#descriptions-tab-pane" type="button" role="tab" aria-controls="descriptions-tab-pane" aria-selected="true">{{ __('course-detail.lessons') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link view-tab @if (session('success')) active  @endif"  id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-tab-pane" type="button" role="tab" aria-controls="documents-tab-pane" aria-selected="false">{{ __('course-detail.programs') }}</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade @if (!session('success')) show active  @endif " id="descriptions-tab-pane" role="tabpanel" aria-labelledby="descriptions-tab" tabindex="0">
            @if (!$lesson->IsJoinedLesson)
            <form action="{{ route('user-lesson.store') }}" class="start-learn-lesson" method="POST">
                @csrf
                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                <button type="submit">Start Learn Lesson</button>
                <div class="clear"></div>
            </form>
            @elseif($lesson->IsFinishLesson)
            <div class="btn btn-danger btn-lesson-learned">You have finish this lesson</div>
                <div class="clear"></div>
            @else
                <div class="btn btn-success btn-lesson-learned">You have learn this lesson</div>
                <div class="clear"></div>
            @endif
            <div class="descriptons-item">
                <div class="title">
                    {{ __('lesson.description_lesson') }}
                </div>
                <div class="content">
                    {{ $lesson->content }}
                </div>
            </div>
            <div class="descriptons-item">
                <div class="title">
                    {{ __('lesson.requirements') }}
                </div>
                <div class="content">
                    {{ $lesson->requirements }}
                </div>
            </div>
        </div>
        <div class="tab-pane fade @if (session('success')) show active  @endif" id="documents-tab-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">
            <div class="programs">
                <div class="title">
                    Programs
                </div>
                <div class="level-finish">
                    <div class="side">
                        <div>Your Level</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                          <div class="bar-status" style="width: {{ ($lesson->programs->count() > 0 ? $countUserPrograms / $lesson->programs->count() : 0) * 100 }}%"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div> {{ round(($lesson->programs->count() > 0 ? $countUserPrograms / $lesson->programs->count() : 0) * 100) }} %</div>
                    </div>
                    <div class="clear"></div>
                </div>
                @foreach ($lesson->programs as $key => $program)
                <div class="programs-items">
                    <div class="image">
                        <img src="{{ asset('images/'.$program->pictureProgram.'.png') }}" alt="">
                    </div>
                    <div class="type">
                        {{ $program->typeProgram }}
                    </div>
                    <div class="name">
                        {{ $program->program_name }}
                    </div>
                    <div class="link">
                        @if ($lesson->IsJoinedLesson)
                            @if (!$program->IsJoinedPrograms)
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
                </div>
                @endforeach
            </div>
        </div>
      </div>
      <div class="line-tag">
        <div class="tag-items title"> Tag :  </div>
        @foreach ($tags as $key => $tag)
        <div class="tag-items">
            <a href="{{ route('course.index',['tags'=>[$tag->id]]) }}" class="tag-items-link">
               # {{ $tag->tag_name }}
            </a>
        </div>
        @endforeach
        <div class="clear"></div>
      </div>
</div>
