@extends('layouts.app')

@section('content')

<div class="container profile-templete">
    <div class="row">
        <div class="col-3 profile-first-info">
            <form action="{{ route('profile.update', [auth()->id()])}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="group-avatar">
                <div class="avatar">
                    <img src="{{ asset( $user->avatar ) }}" id="img-preview" alt="">
                </div>
                <div class="upload-avatar">
                    <input type="file" name="avatar" id="file" class="inputfile" accept=".png, .jpeg, .PNG, .jpg" />
                    <label for="file"><i class="fa-solid fa-camera"></i></label>
                </div>
                <div class="name">
                    {{$user->name}}
                </div>
                <div class="email">
                    {{$user->email}}
                </div>
            </div>
            <div class="group-avatar-2">
                <div class="item">
                    <div class="span-birth-image">
                        <img src="{{ asset('images/d-o-b.png') }}" alt="">
                    </div>
                    <p>
                        @if ($user->date_of_birth)
                            {{date('d-m-Y', strtotime($user->date_of_birth));}}
                        @else
                            <span>Chưa cập nhật</span>
                        @endif
                    </p>
                </div>
                <div class="item">
                    <div class="span-birth-image">
                        <img src="{{ asset('images/call.png') }}" alt="">
                    </div>
                    <p>
                        @if ($user->phone)
                            {{$user->phone}}
                        @else
                            <span>Chưa cập nhật</span>
                        @endif
                    </p>
                </div>
                <div class="item">
                    <div class="span-birth-image">
                        <img src="{{ asset('images/home.png') }}" alt="">
                    </div>
                    <p>
                        @if ($user->address)
                            {{$user->address}}
                        @else
                            <span>Chưa cập nhật</span>
                        @endif
                    </p>
                </div>
                <div class="description">
                    {{$user->about_me}}
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="profile-list-course">
                <div class="title">
                    My course
                </div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="content">
                    @foreach ($course as $course)
                    <div class="item">
                        <a href=" {{ route('course.show', [$course->slug_course]) }} ">
                            <img src="{{$course->image}}" alt="">
                            <div class="name">
                                {{$course->course_name}}
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <div class="item">
                        <a href="{{ route('course.index')}}">
                            <div class="add-item-icon">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </a>
                        <div class="name add-name">
                            Add course
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="profile-list-course edit-profile">
                <div class="title">
                    Edit Profile
                </div>
                <div class="line"></div>
                <div class="line"></div>
                    <div class="row row-edit-profile">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name : </label>
                                <input  type="text"
                                        class="form-control"
                                        placeholder="Your Name"
                                        name="name"
                                        value="{{$user->name}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Date of birth : </label>
                                <input  type="date"
                                        class="form-control"
                                        placeholder="dd/mm/yyyy"
                                        name="date_of_birth"
                                        value="{{$user->date_of_birth}}">
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name : </label>
                                <input  type="text"
                                        class="form-control"
                                        placeholder="Address"
                                        name="address"
                                        value="{{$user->address}}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email : </label>
                                <input  type="text"
                                        class="form-control"
                                        placeholder="Email"
                                        name="email"
                                        value="{{$user->email}}"
                                        disabled>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone : </label>
                                <input  type="text"
                                        class="form-control"
                                        placeholder="Your Phone Number"
                                        name="phone"
                                        value="{{$user->phone}}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">About me : </label>
                                <textarea
                                    class="form-control"
                                    placeholder="Write something here"
                                    id="floatingTextarea"
                                    rows="5"
                                    name="about_me">{{$user->about_me}}</textarea>
                                @error('about_me')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="button-save">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Do you want to update?')">Save</button>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection