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
                <div class="card-header">Add New Tags</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tags.store') }}">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tag Name</label>
                          <input type="text"  class="form-control @error('tag_name') is-invalid @enderror" aria-describedby="emailHelp" onkeyup="ChangeToSlug();" id="slug" placeholder="Add a Tag name . . ." name="tag_name" value="{{old('tag_name')}}" >
                        @error('tag_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Tag</label>
                            <input type="text" class="form-control @error('slug_tag') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Add  Slug . . . " name="slug_tag" value="{{old('slug_tag')}}" id="convert_slug">
                            @error('slug_tag')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="{{ config('tag.status') }}">Active</option>
                                <option value="{{ config('tag.end_status') }}">Not Active</option>
                              </select>
                              @error('status')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create new tag</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
