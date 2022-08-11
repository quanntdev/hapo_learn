<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white  height-nav shadow-sm">
        <div class="header-content">
            <a class="navbar-brand" href="{{route('home')}}">
                <img class="logo-image" src="{{ asset('images/logo.png') }}" alt="HapoLearn Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="getElementById('mobieHeader').classList.toggle('show')">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse nav-show navbar-collapse" id="mobieHeader">
                <ul class="navbar-nav bg-white nav-mobie mr-auto w-100">
                    <li class="nav-item active @if(url()->current() == url('/')) on-active @endif">
                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item  @if(url()->current() == route('course.index')) on-active @endif">
                        <a class="nav-link" href="{{ route('course.index') }}">All courses <span class="sr-only">(current)</span></a>
                    </li>
                    @if (!Auth::user())
                    <li class="nav-item @if(url()->current() == route('login')) on-active @endif">
                        <a class="nav-link" href="{{route('login')}}">Login/Register <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    <li class="nav-item @if(url()->current() == route('profile.index')) on-active @endif">
                        <a class="nav-link" href="{{ route('profile.index') }}">profile <span class="sr-only">(current)</span></a>
                    </li>
                    @if (Auth::user())
                    <li class="nav-item button-logout">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
