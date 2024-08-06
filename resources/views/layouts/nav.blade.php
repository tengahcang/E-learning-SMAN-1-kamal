    @php
    $currentRouteName = Route::currentRouteName();
@endphp

{{-- <nav class="navbar navbar-expand-md navbar-dark bg-primary">
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

                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('admin') }}"
                                class="nav-link @if ($currentRouteName == 'admin') active @endif">beranda</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('students.index') }}"
                                class="nav-link @if ($currentRouteName == 'students.index') active @endif">siswa</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('teachers.index') }}"
                                class="nav-link @if ($currentRouteName == 'teachers.index') active @endif">guru</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('subjects.index') }}"
                                class="nav-link @if ($currentRouteName == 'subjects.index') active @endif">Mata Pelajaran</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('classes.index') }}"
                                class="nav-link @if ($currentRouteName == 'classes.index') active @endif">Kelas</a></li>
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('rooms.index') }}"
                                class="nav-link @if ($currentRouteName == 'rooms.index') active @endif">Room</a></li>
                    @elseif (Auth::user()->role == 'guru')
                        <li class="nav-item col-2 col-md-auto"> <a href="{{ route('guru') }}" class="nav-link @if ($currentRouteName == 'guru') active @endif">beranda</a></li>
                        {{-- <li class="nav-item col-2 col-md-auto">Dashboard</li> --}}
{{-- <li class="nav-item col-2 col-md-auto">Matpel</li> --}}
{{-- @elseif (Auth::user()->role == "siswa") --}}
{{-- <li class="nav-item col-2 col-md-auto"><a href="{{ route('siswa') }}" class="nav-link @if ($currentRouteName == 'guru') active @endif">beranda</a></li> --}}

{{-- <li class="nav-item col-2 col-md-auto">Matpel</li> --}}
{{-- <li class="nav-item col-2 col-md-auto">Tugas</li> --}}
{{-- @endif  --}}
{{-- <li class="nav-item col-2 col-md-auto"><a href="{{ route('home') }}" class="nav-link @if ($currentRouteName == 'home') active @endif">Home</a></li> --}}
{{-- <li class="nav-item col-2 col-md-auto"><a href="{{ route('employees.index') }}" class="nav-link @if ($currentRouteName == 'employees.index') active @endif">Employee</a></li> --}}
{{-- </ul>
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
                                <a class="btn btn-outline-light my-2 ms-md-auto"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
{{-- <a class="btn btn-outline-light my-2 ms-md-auto"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="btn btn-outline-light my-2 ms-md-auto" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi-person-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role == 'admin')
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
            </div> --}}

{{-- <a href="{{ route('profile') }}" class="btn btn-outline-light my-2 ms-md-auto"><i class="bi-person-circle me-1"></i> My Profile</a> --}}
{{-- </div>
    </div>
</nav> --}}

<nav class="row g-0">
    <!-- Sidebar -->
    <aside id="sidebar" class="col-md-3 col-12 bg-white sidebar side-pc p-4">
        <a class="navbar-brand text-black  align-items-center  d-flex " href="#">
            <img src="{{ asset('img/logo.png') }}" class="logo-brand" width="50" />
            <span> EL - SMAN 1 Kamal</span>

        </a>
        <ul class="nav flex-column mt-4">
            @guest
                <li class="nav-item mb-3">
                    <a class="nav-link active" href="#"><i
                            class="bi bi-journal-bookmark-fill icon-sidebar "></i><span>BERANDA</span></a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link" href="#"><i
                            class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>IPA</span></a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link" href="#"><i
                            class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>IPS</span></a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link" href="#"><i
                            class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>MATEMATIKA</span></a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link" href="#"><i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>BAHASA
                            INDONESIA</span></a>
                </li>
            @else
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item mb-3">
                        <a href="{{ route('admin') }}" class="nav-link @if ($currentRouteName == 'admin') active @endif">
                            <i class="bi bi-app-indicator icon-sidebar"></i><span>BERANDA</span>
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="{{ route('teachers.index') }}"
                            class="nav-link @if ($currentRouteName == 'teachers.index') active @endif">
                            <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>GURU</span>
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="{{ route('students.index') }}"
                            class="nav-link @if ($currentRouteName == 'students.index') active @endif">
                            <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>SISWA</span>
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="{{ route('subjects.index') }}"
                            class="nav-link @if ($currentRouteName == 'subjects.index') active @endif">
                            <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>MATA PELAJARAN</span>
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="{{ route('classes.index') }}"
                            class="nav-link @if ($currentRouteName == 'classes.index') active @endif">
                            <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>KELAS</span>
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="{{ route('rooms.index') }}"
                            class="nav-link @if ($currentRouteName == 'rooms.index') active @endif">
                            <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>ROOM</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'guru')
                    <li class="nav-item mb-3">
                        <a href="{{ route('guru') }}" class="nav-link @if ($currentRouteName == 'guru') active @endif">
                            <i class="bi bi-app-indicator icon-sidebar"></i><span>DASHBOARD</span>
                        </a>
                    </li>
                    @foreach ($rooms as $room)
                        <li class="nav-item mb-3">
                            <a href="{{ route('teacher.matapelajaran.index', ['id_room' => $room->id]) }}"
                                class="nav-link @if ($currentRouteName == 'teacher.matapelajaran.index' && request()->id_room == $room->id) active @endif">
                                <i
                                    class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>{{ $room->class->name }}-{{ $room->subject->name }}</span>
                            </a>
                        </li>
                    @endforeach


                @elseif (Auth::user()->role == 'siswa')
                    <li class="nav-item mb-3">
                        <a href="{{ route('siswa') }}" class="nav-link @if ($currentRouteName == 'siswa') active @endif">
                            <i class="bi bi-app-indicator icon-sidebar"></i><span>DASHBOARD</span>
                        </a>
                    </li>
                    @foreach ($room_siswas as $room)
                        <li class="nav-item mb-3">
                            <a href="{{ route('student.matapelajaran.index', ['id_room' => $room->id_room]) }}"
                                class="nav-link @if ($currentRouteName == 'student.matapelajaran.index' && request()->id_room == $room->id_room) active @endif">
                                <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>{{ $room->room->subject->name }}
                                    - {{ $room->room->class->name }}</span>
                            </a>
                        </li>
                    @endforeach


                @endif
            @endguest
        </ul>

    </aside>
    <!-- Main content -->
    {{-- <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
        <div class="offcanvas-header">
            <div></div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="sidebar" class="col-md-3 col-12 bg-white sidebar p-4">
                <a class="navbar-brand text-black align-items-center d-flex" href="#">
                    <img src="{{ asset('img/logo.png') }}" class="logo-brand" width="50" />
                    <span> EL - SMAN 1 Kamal</span>
                </a>
                @if (Auth::user()->role == 'admin')
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item mb-3">
                            <a href="{{ route('admin') }}"
                                class="nav-link @if ($currentRouteName == 'admin') active @endif">
                                <i class="bi bi-app-indicator icon-sidebar"></i><span>BERANDA</span>
                            </a>
                        </li>
                        <li class="nav-item mb-3">
                            <a href="{{ route('students.index') }}"
                                class="nav-link @if ($currentRouteName == 'students.index') active @endif">
                                <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>SISWA</span>
                            </a>
                        </li>
                        <li class="nav-item mb-3">
                            <a href="{{ route('teachers.index') }}"
                                class="nav-link @if ($currentRouteName == 'teachers.index') active @endif">
                                <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>GURU</span>
                            </a>
                        </li>
                        <li class="nav-item mb-3">
                            <a href="{{ route('subjects.index') }}"
                                class="nav-link @if ($currentRouteName == 'subjects.index') active @endif">
                                <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>MATA PELAJARAN</span>
                            </a>
                        </li>
                        <li class="nav-item mb-3">
                            <a href="{{ route('classes.index') }}"
                                class="nav-link @if ($currentRouteName == 'classes.index') active @endif">
                                <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>KELAS</span>
                            </a>
                        </li>
                        <li class="nav-item mb-3">
                            <a href="{{ route('rooms.index') }}"
                                class="nav-link @if ($currentRouteName == 'rooms.index') active @endif">
                                <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>ROOM</span>
                            </a>
                        </li>
                    </ul>
                @elseif (Auth::user()->role == 'guru')
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item mb-3">
                            <a href="{{ route('guru') }}"
                                class="nav-link @if ($currentRouteName == 'guru') active @endif">
                                <i class="bi bi-app-indicator icon-sidebar"></i><span>DASHBOARD</span>
                            </a>
                        </li>
                        @foreach ($rooms as $room)
                            <li class="nav-item mb-3">
                                <a href="{{ route('teacher.matapelajaran.index', ['id_room' => $room->id]) }}"
                                    class="nav-link @if ($currentRouteName == 'teacher.matapelajaran.index' && request()->id_room == $room->id) active @endif">
                                    <i
                                        class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>{{ $room->class->name }}-{{ $room->subject->name }}</span>
                                </a>

                            </li>
                        @endforeach
                    </ul>
                @elseif (Auth::user()->role == 'siswa')
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item mb-3">
                            <a href="{{ route('siswa') }}"
                                class="nav-link @if ($currentRouteName == 'siswa') active @endif">
                                <i class="bi bi-app-indicator icon-sidebar"></i><span>DASHBOARD</span>
                            </a>
                        </li>
                        @foreach ($room_siswas as $room)
                        <li class="nav-item mb-3">
                            <a href="{{ route('student.matapelajaran.index', ['id_room' => $room->id_room]) }}"
                                class="nav-link @if ($currentRouteName == 'student.matapelajaran.index' && request()->id_room == $room->id_room) active @endif">
                                <i class="bi bi-journal-bookmark-fill icon-sidebar"></i><span>{{ $room->room->subject->name }}
                                    - {{ $room->room->class->name }}</span>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div> --}}

    <div id="main-content" class="col-md-9 col-12">
        <nav class="navbar navbar-light">
            <div class="container-fluid">
                <button id="toggle-sidebar" class="button-hamburger button-hamburger-pc">
                    <i class="bi bi-list text-white"></i>
                </button>
                <button id="toggle-sidebar" class="button-hamburger button-hamburger-mobile"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                    <i class="bi bi-list text-white"></i>
                </button>
                <div class="dropdown dropstart">
                    <button
                        class="dropdown-navbar text-white  dropdown-toggle align-items-center justify-content-center d-flex"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">

                        {{ Auth::user()->name }}
                        <img src="{{ asset('img/user.png') }}" class="ms-2" width="40" />
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            @if (Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{ Route('profile') }}">
                                    Profile
                                </a>
                            @elseif (Auth::user()->role == 'guru')
                                <a class="dropdown-item" href="{{ Route('teacher.profile') }}">
                                    Profile
                                </a>
                            @elseif (Auth::user()->role == 'siswa')
                                <a class="dropdown-item" href="{{ Route('student.profile') }}">
                                    Profile
                                </a>
                            @endif
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <main class="p-5">
            @yield('content')
        </main>

    </div>
</nav>
<script>
    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var mainContent = document.getElementById('main-content');
        if (sidebar.classList.contains('col-md-3')) {
            sidebar.classList.remove('col-md-3');
            sidebar.classList.add('col-md-1');
            mainContent.classList.remove('col-md-9');
            mainContent.classList.add('col-md-11');
        } else {
            sidebar.classList.remove('col-md-1');
            sidebar.classList.add('col-md-3');
            mainContent.classList.remove('col-md-11');
            mainContent.classList.add('col-md-9');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
