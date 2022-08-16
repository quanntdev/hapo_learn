@extends('admin.layouts.app')

@section('admin-content')

<div class="container">
    @if (session('success'))
    <div class="toast toast-profile" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
        <div class="toast-header">
            <strong class="me-auto">HapoLearn</strong>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="getElementById('toast').classList.toggle('none')"></button>
        </div>
        <div class="toast-body text-success">
            {{ session('success') }}
        </div>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Edit Course : {{ $course->course_name }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('course.update', [$course->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Course's Name</label>
                          <input type="text"  class="form-control @error('course_name') is-invalid @enderror" aria-describedby="emailHelp" onkeyup="ChangeToSlug();" id="slug" placeholder="Add a Course's name . . ." name="course_name" value="{{ $course->course_name }}" >
                          @error('course_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Course</label>
                            <input type="text" class="form-control @error('slug_course') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Add  Slug . . . " name="slug_course" value="{{ $course->slug_course }}" id="convert_slug">
                            @error('slug_course')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Description</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="description" @error('description') is-invalid @enderror> {{ $course->description }} </textarea>
                                <label for="floatingTextarea2">Description</label>
                              </div>
                            @error('description')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Upload Images</label>
                            <div class="form-floating">
                                <input type="file" name="image" id="file" accept=".png, .jpeg, .PNG, .jpg" />
                            <div class="avatar mt-3">
                                <img src="{{ asset($course->image) }}" id="img-preview" alt="" class="img-on-edit">
                            </div>
                            </div>
                            @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" aria-describedby="emailHelp" name="price" value="{{ $course->price }}">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Teacher</label>
                            <select class="form-select" aria-label="Default select example" multiple name="teachers[]">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" @if (in_array($teacher->id, $course->teachers->pluck('id')->toArray())) selected @endif>{{ $teacher->name }}
                                    </option>
                                @endforeach
                              </select>
                              @error('teachers')
                              <span class="d-block invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tags</label>
                            <select class="form-select" aria-label="Default select example" multiple name="tags[]">
                                @foreach ($tags as $key => $tag)
                                    <option value="{{ $tag->id }}" @if (in_array($tag->id, $course->tags->pluck('id')->toArray())) selected @endif>{{ $tag->tag_name }}
                                    </option>
                                @endforeach
                              </select>
                              @error('tags')
                              <span class="d-block invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="{{ config('tag.status') }}" @if ($course->status == config('tag.status'))  selected @endif >Active</option>
                                <option value="{{ config('tag.end_status') }}" @if ($course->status == config('tag.end_status'))  selected @endif>Not Active</option>
                              </select>
                              @error('status')
                              <span class="d-block invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update this Course</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
