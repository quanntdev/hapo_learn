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
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="">
            <div class="card">
                <div class="card-header">Show all Courses</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      <table class="table table-dark  table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Course's Name</th>
                              <th scope="col">Slug Course</th>
                              <th scope="col">Image</th>
                              <th scope="col">Price</th>
                              <th scope="col">Status</th>
                              <th scope="col">Manager</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($courses as $key => $course)

                            <tr>
                              <th scope="row">{{ $key+1 }}</th>
                              <td>{{ $course->course_name }}</td>
                              <td>{{ $course->slug_course }}</td>
                              <td>
                                <img src="{{ $course->image }}" alt="" style="width: 300px; height:150px; object-fit:cover">
                              </td>
                              <td> {{ $course->prices }} </td>
                              <td>
                                @if($course->status == config('tag.status'))
                                <p class="text-success">Active</p>
                                @else
                                <p class="text-danger">Not Active</p>
                                @endif
                              </td>
                              <td>
                                    <div class="d-flex">
                                    <a href="{{route('course.show', [$course->slug_course])}} " class="btn btn-primary ">Show</a>
                                      {{-- <form action="{{route('tags.destroy',[$tag->id])}}" method ="POST">
                                      @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger ms-2" onclick="return confirm('Do you want to delete this Tag\'name')">Delete</button>
                                    </form> --}}
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
