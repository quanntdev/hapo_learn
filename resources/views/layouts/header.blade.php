<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white  height-nav shadow-sm">
        <div class="header-content">
            <a class="navbar-brand" href="{{route('home')}}">
                <img class="logo-image" src="{{ asset('images/logo.png') }}" alt="HapoLearn Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse nav-show navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav bg-white nav-mobie mr-auto w-100">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">All courses <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('login')}}">Login/Register <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">profile <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
