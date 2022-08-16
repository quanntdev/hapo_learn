<form action="{{ route('lessons.update',[$lesson->id] ) }}" class="d-block" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <input type="hidden" class="form-control w-100" aria-describedby="emailHelp"  placeholder="Course name . . . " name="course_id" value="{{ $course->id }}" >
      </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Lesson Name</label>
        <input type="text"  class="form-control w-100  @error('name_lesson') is-invalid @enderror" aria-describedby="emailHelp" onkeyup="ChangeToSlug();" id="slug" placeholder="Lesson name . . . " name="name_lesson" value="{{ $lesson->name_lesson }}" >
      @error('name_lesson')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Slug Lesson</label>
        <input type="text" class="form-control w-100 @error('slug_lesson') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Add Slug . . . " name="slug_lesson" value="{{ $lesson->slug_lesson }}" id="convert_slug">
        @error('slug_lesson')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Description</label>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="content" @error('content') is-invalid @enderror>{{ $lesson->content }}</textarea>
            <label for="floatingTextarea2 text-body">Description</label>
          </div>
        @error('content')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Requirements</label>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="requirement" @error('requirement') is-invalid @enderror>{{ $lesson->requirement }}</textarea>
            <label for="floatingTextarea2 text-body">requirements</label>
          </div>
        @error('requirement')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Time Lesson</label>
        <div class="form-floating">
            <input type="time" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="time_lesson" @error('time_lesson') is-invalid @enderror value="{{ $lesson->time_lesson }}">
            <label for="floatingTextarea2 text-body">Time Lesson</label>
          </div>
        @error('time_lesson')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Time Lesson</label>
        <select name="status" class="form-select" id="js-example-basic-single">
            <option value="{{ config('tag.status') }}" @if ($lesson->status == config('tag.status'))  selected @endif >Active</option>
            <option value="{{ config('tag.end_status') }}" @if ($lesson->status == config('tag.end_status'))  selected @endif>Not Active</option>
        </select>
    </div>
    <div style="display: none">
        <select name="" id="js-example-basic-single" class="js-example-basic-single" style="display: none !importan">
            <option value="">Select Course</option>
           <option value="">2</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Edit Lesson</button>
</form>