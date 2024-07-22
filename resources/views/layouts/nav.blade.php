@php
    $currentRouteName = Route::currentRouteName();
@endphp
<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <hr class="d-md-none text-white-50">
            @guest
                <ul class="navbar-nav flex-row flex-wrap">

                </ul>
            @else
                <ul class="navbar-nav flex-row flex-wrap">
                    @if (Auth::user()->role == "admin")
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('admin') }}" class="nav-link @if($currentRouteName == 'admin') active @endif">beranda</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('students.index') }}" class="nav-link @if($currentRouteName == 'students.index') active @endif">siswa</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('teachers.index') }}" class="nav-link @if($currentRouteName == 'teachers.index') active @endif">guru</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('subjects.index') }}" class="nav-link @if($currentRouteName == 'subjects.index') active @endif">Mata Pelajaran</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('classes.index') }}" class="nav-link @if($currentRouteName == 'classes.index') active @endif">Kelas</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('rooms.index') }}" class="nav-link @if($currentRouteName == 'rooms.index') active @endif">Room</a></li>
                    @elseif (Auth::user()->role == "guru")
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('guru') }}" class="nav-link @if($currentRouteName == 'guru') active @endif">beranda</a></li>
                        {{-- <li class="nav-item col-2 col-md-auto">Dashboard</li> --}}
                        <li class="nav-item col-2 col-md-auto">Matpel</li>
                    @elseif (Auth::user()->role == "siswa")
                        <li class="nav-item col-2 col-md-auto"><a href="{{ route('siswa') }}" class="nav-link @if($currentRouteName == 'guru') active @endif">beranda</a></li>
                        <li class="nav-item col-2 col-md-auto">Matpel</li>
                        <li class="nav-item col-2 col-md-auto">Tugas</li>
                    @endif
                    {{-- <li class="nav-item col-2 col-md-auto"><a href="{{ route('home') }}" class="nav-link @if($currentRouteName == 'home') active @endif">Home</a></li> --}}
                    {{-- <li class="nav-item col-2 col-md-auto"><a href="{{ route('employees.index') }}" class="nav-link @if($currentRouteName == 'employees.index') active @endif">Employee</a></li> --}}
                </ul>
                @endguest

            <hr class="d-md-none text-white-50">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="btn btn-outline-light my-2 ms-md-auto" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                                <a class="btn btn-outline-light my-2 ms-md-auto" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="btn btn-outline-light my-2 ms-md-auto" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi-person-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role == "admin")
                                    <a class="dropdown-item" href="">
                                        Profile
                                    </a>
                                @elseif (Auth::user()->role == "guru")
                                    <a class="dropdown-item" href="">
                                        Profile
                                    </a>
                                @elseif (Auth::user()->role == "siswa")
                                    <a class="dropdown-item" href="{{ route('student.profile') }}">
                                        Profile
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>

            {{-- <a href="{{ route('profile') }}" class="btn btn-outline-light my-2 ms-md-auto"><i class="bi-person-circle me-1"></i> My Profile</a> --}}
        </div>
    </div>
</nav>
