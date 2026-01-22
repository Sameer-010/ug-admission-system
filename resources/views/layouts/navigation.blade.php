<nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top" style="background-color:#003366; z-index:1200;">
    <div class="container-fluid px-4">

        <!-- Logo + Title -->
        <a class="navbar-brand d-flex align-items-center fw-bold text-white"
           href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard')) : url('/') }}">
            <img src="{{ asset('images/ug-logo.png') }}" alt="UG Logo"
                 style="height:55px; width:auto; margin-right:10px;">

            <div class="lh-sm">
                <span class="fs-5 fw-bold">University of Gwadar</span><br>
                <small class="text-light opacity-75">
                    <i class="bi bi-star-fill text-warning"></i>
                    Excellence in Education
                </small>
            </div>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">

                @if(Auth::check())

                    {{-- Fetch Notifications --}}
                    @php
                        $unread = \App\Models\Notification::where('user_id', Auth::id())
                                    ->where('is_read', false)
                                    ->count();

                        $latestNotifications = \App\Models\Notification::where('user_id', Auth::id())
                                    ->latest()
                                    ->take(5)
                                    ->get();
                    @endphp

                    {{-- Notification Bell --}}
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link position-relative text-white"
                           href="#" id="notifDropdown" data-bs-toggle="dropdown">

                            <i class="bi bi-bell-fill fs-4"></i>

                            @if($unread > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $unread }}
                                </span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-4 p-2"
                            style="min-width:260px;">

                            <li class="dropdown-header fw-bold">Notifications</li>

                            @forelse($latestNotifications as $n)
                                <li>
                                    <a class="dropdown-item small py-2 d-block {{ $n->is_read ? '' : 'fw-bold bg-light' }}"
                                       href="{{ route('notifications.read.single', $n->id) }}">

                                        <i class="bi bi-info-circle me-2 text-primary"></i>

                                        {{ $n->title }}

                                        <br>
                                        <span class="text-muted small d-block">
                                            {{ \Illuminate\Support\Str::limit($n->message, 40) }}
                                        </span>
                                    </a>
                                </li>
                            @empty
                                <li class="text-center text-muted small py-2">
                                    No notifications
                                </li>
                            @endforelse

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a href="{{ route('notifications.index.all') }}"
                                   class="dropdown-item text-primary small text-center">
                                    View All Notifications
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Dark Mode --}}
                    <li class="nav-item mx-2">
                        <button id="darkModeBtn"
                                class="btn btn-outline-light rounded-circle p-2">
                            <i class="bi bi-moon-stars-fill fs-6"></i>
                        </button>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white fw-semibold"
                           href="#" id="userDropdown" data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle me-2 fs-5 text-warning"></i>

                            <span>{{ Auth::user()->name }}</span>

                            <span class="badge bg-info text-dark ms-2 small">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-4" style="min-width:220px;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2"
                                   href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-lines-fill me-2"></i> Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-item py-2 text-danger d-flex align-items-center">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    {{-- Guest --}}
                    <li class="nav-item mx-2">
                        <a class="btn btn-warning rounded-pill px-3 text-dark fw-semibold"
                           href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>

<style>
    .dropdown-menu {
        z-index: 1400;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Fix dropdowns
    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(el => {
        try { new bootstrap.Dropdown(el); } catch(e) {}
    });

    // Dark mode toggle
    const darkBtn = document.getElementById("darkModeBtn");
    if (darkBtn) {
        darkBtn.addEventListener("click", () => {
            document.body.classList.toggle("bg-dark");
            document.body.classList.toggle("text-white");
        });
    }

});
</script>
