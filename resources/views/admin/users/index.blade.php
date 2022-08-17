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
                <div class="card-header">Show all Users</div>

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
                              <th scope="col">User's Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Role</th>
                              <th scope="col">Create at</th>
                              <th scope="col">Manager</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($users as $key => $user)

                            <tr>
                              <th scope="row">{{ $key+1 }}</th>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                <p class="" style="color: {{ $user->roles['color'] }} ">{{ $user->roles['roles'] }}</p>
                              </td>
                              <td> {{ $user->TimeCreate }} </td>
                              <td>
                                @if( $user->role == config('roles.normal_user'))
                                <div class="d-flex">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{ config('roles.teacher') }}">
                                        <button type="submit" class="btn btn-success">Update to Teacher</button>
                                    </form>
                                </div>
                                @elseif( $user->role == config('roles.teacher'))
                                <div class="d-flex">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{ config('roles.normal_user') }}">
                                        <button type="submit" class="btn btn-warning">Delete Roles Teacher</button>
                                    </form>
                                </div>
                                @endif
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
