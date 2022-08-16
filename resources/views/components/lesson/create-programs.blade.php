<form action="{{ route('programs.store') }}" class="d-block" method="POST">
    @csrf
    <div class="mb-3">
        <input type="hidden" class="form-control w-100" aria-describedby="emailHelp"  placeholder="Course name . . . " name="lesson_id" value="{{ $lesson->id }}" >
      </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Program Name</label>
        <input type="text"  class="form-control w-100  @error('program_name') is-invalid @enderror" aria-describedby="emailHelp"  placeholder="Programs name . . . " name="program_name" value="{{old('program_name')}}" >
      @error('program_name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Type of file</label>
        <select name="type" class="form-select" id="js-example-basic-single">
            <option value="{{ config('program.value_doc') }}">Documents</option>
            <option value="{{ config('program.value_pdf') }}">PDF</option>
            <option value="{{ config('program.value_video') }}">Video</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">File (now is a Link)</label>
        <input type="text"  class="form-control w-100  @error('file') is-invalid @enderror" aria-describedby="emailHelp"  placeholder="Link File . . ." name="file" value="{{old('file')}}" >
      @error('file')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-body">Time Lesson</label>
        <select name="status" class="form-select" id="js-example-basic-single">
            <option value="{{ config('tag.status') }}">Active</option>
            <option value="{{ config('tag.end_status') }}">Not Active</option>
        </select>
    </div>
    <div style="display: none">
        <select name="" id="js-example-basic-single" class="js-example-basic-single" style="display: none !importan">
            <option value="">Select Course</option>
           <option value="">2</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create Lesson</button>
</form>