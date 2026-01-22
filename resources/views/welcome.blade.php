<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UG Admission System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .bg-ug-blue { background: linear-gradient(135deg, #003d82 0%, #0052a8 100%); }
        .text-ug-blue { color: #003d82; }
        .btn-ug-blue { background-color: #003d82; color: white; border: none; }
        .btn-ug-blue:hover { background-color: #0052a8; color: white; }
        .gradient-text { background: linear-gradient(90deg, #003d82, #ffc107); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body>

    <!-- Navbar with Glass Effect -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow sticky-top">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/ug-logo.png') }}" alt="UG Logo" height="70" class="me-3">
                <div>
                    <div class="fw-bold fs-3 text-ug-blue">University of Gwadar</div>
                    <small class="text-muted d-flex align-items-center gap-1">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        Excellence in Education
                    </small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    @auth
                        <li class="nav-item">
                            <a class="btn btn-outline-primary rounded-pill px-4" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-primary rounded-pill px-4" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-ug-blue rounded-pill px-5 py-2 shadow-lg" href="{{ route('register') }}">
                                <i class="bi bi-rocket-takeoff-fill me-2"></i>Apply Now
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mega Hero Section -->
    <div class="bg-ug-blue text-white">
        <div class="container py-5">
            <div class="row align-items-center g-5 py-5">
                <div class="col-lg-6">
                    <div class="badge bg-warning text-dark px-4 py-3 rounded-pill mb-4 fs-5 fw-bold shadow-lg">
                        <i class="bi bi-megaphone-fill me-2"></i>ADMISSIONS 2025 OPEN NOW!
                    </div>
                    <h1 class="display-2 fw-bold mb-4 lh-1">
                        Your Future<br>Starts <span class="text-warning">Here</span>
                    </h1>
                    <p class="lead fs-3 mb-5 opacity-90">
                        Join Pakistan's premier university in Gwadar. World-class education, unlimited opportunities.
                    </p>
                    
                    <!-- Stats Row -->
                    <div class="row g-3 mb-5">
                        <div class="col-4">
                            <div class="text-center bg-white bg-opacity-10 rounded-4 p-3">
                                <h2 class="display-5 fw-bold text-warning mb-0">5000+</h2>
                                <small class="text-white-50">Students</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center bg-white bg-opacity-10 rounded-4 p-3">
                                <h2 class="display-5 fw-bold text-warning mb-0">95%</h2>
                                <small class="text-white-50">Success</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center bg-white bg-opacity-10 rounded-4 p-3">
                                <h2 class="display-5 fw-bold text-warning mb-0">15+</h2>
                                <small class="text-white-50">Programs</small>
                            </div>
                        </div>
                    </div>

                    @guest
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold fs-5">
                                <i class="bi bi-pencil-square me-2"></i>Start Application
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-semibold fs-5">
                                <i class="bi bi-person-circle me-2"></i>Student Login
                            </a>
                        </div>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-warning btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold fs-5">
                            <i class="bi bi-speedometer2 me-2"></i>My Dashboard
                        </a>
                    @endguest
                </div>

                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 rounded-5 p-4 text-center h-100">
                                <i class="bi bi-trophy-fill display-1 text-warning mb-3"></i>
                                <h5 class="fw-bold">HEC Recognized</h5>
                                <p class="small opacity-75 mb-0">Fully accredited university</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 rounded-5 p-4 text-center h-100">
                                <i class="bi bi-laptop display-1 text-warning mb-3"></i>
                                <h5 class="fw-bold">100% Online</h5>
                                <p class="small opacity-75 mb-0">Apply from anywhere</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 rounded-5 p-4 text-center h-100">
                                <i class="bi bi-lightning-charge-fill display-1 text-warning mb-3"></i>
                                <h5 class="fw-bold">Instant Updates</h5>
                                <p class="small opacity-75 mb-0">Real-time tracking</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 rounded-5 p-4 text-center h-100">
                                <i class="bi bi-shield-fill-check display-1 text-warning mb-3"></i>
                                <h5 class="fw-bold">Fully Secure</h5>
                                <p class="small opacity-75 mb-0">Encrypted & safe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Feature Cards -->
    <div class="container" style="margin-top: -50px;">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-body text-center p-5">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-flex mb-4">
                            <i class="bi bi-clock-history text-primary" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Apply in 10 Minutes</h3>
                        <p class="text-muted fs-5 mb-0">Quick and easy online application process</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg rounded-4 h-100 border-success border-5">
                    <div class="card-body text-center p-5">
                        <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-flex mb-4">
                            <i class="bi bi-bell-fill text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Get Notifications</h3>
                        <p class="text-muted fs-5 mb-0">Email alerts for every update on your application</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-body text-center p-5">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-4 d-inline-flex mb-4">
                            <i class="bi bi-award-fill text-warning" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Get Admitted Fast</h3>
                        <p class="text-muted fs-5 mb-0">Quick processing and transparent selection</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Programs Section with Modern Cards -->
    <div class="container py-5 my-5">
        <div class="text-center mb-5 pb-4">
            <h6 class="text-uppercase text-primary fw-bold mb-3">
                <i class="bi bi-mortarboard-fill me-2"></i>Our Programs
            </h6>
            <h2 class="display-4 fw-bold text-ug-blue mb-4">Choose Your Future</h2>
            <p class="lead text-muted fs-4">Department of Computer Science - Undergraduate Programs</p>
        </div>

        <div class="row g-4">
            <!-- BSIT Program -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-5 overflow-hidden h-100">
                    <div class="position-relative">
                        <div class="bg-ug-blue text-white p-5">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h2 class="fw-bold mb-2">BSIT</h2>
                                    <p class="opacity-75 mb-0">Information Technology</p>
                                </div>
                                <div class="bg-warning text-dark rounded-circle p-3">
                                    <i class="bi bi-laptop-fill fs-1"></i>
                                </div>
                            </div>
                            <div class="progress bg-white bg-opacity-25 mb-3" style="height: 12px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;"></div>
                            </div>
                            <p class="small mb-0 opacity-75"><i class="bi bi-people-fill me-2"></i>20 of 50 seats filled - Apply now!</p>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <div class="d-flex gap-3 mb-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 fs-6">
                                <i class="bi bi-clock-fill me-2"></i>4 Years
                            </span>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fs-6">
                                <i class="bi bi-calendar-check-fill me-2"></i>Open
                            </span>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>50 Seats Available</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>8 Semesters Program</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>Industry Oriented</span>
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-ug-blue w-100 py-3 rounded-pill fs-5 fw-bold shadow">
                            <i class="bi bi-arrow-right-circle-fill me-2"></i>Apply for BSIT
                        </a>
                    </div>
                </div>
            </div>

            <!-- BSCS Program -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-5 overflow-hidden h-100 position-relative" style="transform: scale(1.05); z-index: 2;">
                    <div class="position-absolute top-0 start-50 translate-middle">
                        <span class="badge bg-danger px-4 py-2 fs-6 shadow-lg">
                            <i class="bi bi-fire me-2"></i>MOST POPULAR
                        </span>
                    </div>
                    <div class="position-relative">
                        <div class="bg-success text-white p-5">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h2 class="fw-bold mb-2">BSCS</h2>
                                    <p class="opacity-75 mb-0">Computer Science</p>
                                </div>
                                <div class="bg-white text-success rounded-circle p-3">
                                    <i class="bi bi-code-slash fs-1"></i>
                                </div>
                            </div>
                            <div class="progress bg-white bg-opacity-25 mb-3" style="height: 12px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;"></div>
                            </div>
                            <p class="small mb-0 opacity-75"><i class="bi bi-people-fill me-2"></i>20 of 40 seats filled - Hurry up!</p>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <div class="d-flex gap-3 mb-4">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fs-6">
                                <i class="bi bi-clock-fill me-2"></i>4 Years
                            </span>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 fs-6">
                                <i class="bi bi-calendar-check-fill me-2"></i>Open
                            </span>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>40 Seats Available</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>Premium Curriculum</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>Research Focused</span>
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-success w-100 py-3 rounded-pill fs-5 fw-bold shadow">
                            <i class="bi bi-arrow-right-circle-fill me-2"></i>Apply for BSCS
                        </a>
                    </div>
                </div>
            </div>

            <!-- BSSE Program -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-5 overflow-hidden h-100">
                    <div class="position-relative">
                        <div class="bg-warning text-dark p-5">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h2 class="fw-bold mb-2">BSSE</h2>
                                    <p class="opacity-75 mb-0">Software Engineering</p>
                                </div>
                                <div class="bg-dark text-warning rounded-circle p-3">
                                    <i class="bi bi-gear-fill fs-1"></i>
                                </div>
                            </div>
                            <div class="progress bg-dark bg-opacity-25 mb-3" style="height: 12px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 67%;"></div>
                            </div>
                            <p class="small mb-0 opacity-75"><i class="bi bi-people-fill me-2"></i>20 of 30 seats filled - Last chance!</p>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <div class="d-flex gap-3 mb-4">
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 fs-6">
                                <i class="bi bi-clock-fill me-2"></i>4 Years
                            </span>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 fs-6">
                                <i class="bi bi-calendar-check-fill me-2"></i>Limited
                            </span>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>30 Seats Available</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>Practical Training</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center fs-5">
                                <i class="bi bi-check-circle-fill text-success me-3"></i>
                                <span>Project Based</span>
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-warning w-100 py-3 rounded-pill fs-5 fw-bold shadow">
                            <i class="bi bi-arrow-right-circle-fill me-2"></i>Apply for BSSE
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Big CTA Banner -->
    <div class="bg-ug-blue text-white py-5 my-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="display-3 fw-bold mb-4">Don't Wait!</div>
                    <p class="lead fs-3 mb-4">Seats are filling up fast. Secure your future at University of Gwadar today!</p>
                    <div class="d-flex gap-4 align-items-center">
                        <div>
                            <div class="display-4 fw-bold text-warning">120</div>
                            <div class="opacity-75">Total Seats</div>
                        </div>
                        <div class="vr bg-white opacity-25" style="height: 60px;"></div>
                        <div>
                            <div class="display-4 fw-bold text-danger">60</div>
                            <div class="opacity-75">Already Filled</div>
                        </div>
                        <div class="vr bg-white opacity-25" style="height: 60px;"></div>
                        <div>
                            <div class="display-4 fw-bold text-success">60</div>
                            <div class="opacity-75">Still Available</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-5 py-4 rounded-pill shadow-lg fw-bold">
                        <i class="bi bi-rocket-takeoff-fill me-3 fs-4"></i>
                        <span class="fs-2">APPLY NOW</span>
                    </a>
                    <p class="text-white-50 mt-4 mb-0">
                        <i class="bi bi-clock-fill me-2"></i>Takes only 10 minutes
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container py-4">
            <div class="row g-5">
                <div class="col-lg-4">
                    <img src="{{ asset('images/ug-logo.png') }}" alt="UG Logo" height="90" class="mb-4">
                    <h4 class="fw-bold mb-3">University of Gwadar</h4>
                    <p class="text-white-50 fs-5 mb-4">Building tomorrow's leaders through excellence in education</p>
                    <div class="d-flex gap-2">
                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                            <i class="bi bi-trophy-fill me-1"></i>HEC Recognized
                        </span>
                        <span class="badge bg-success px-3 py-2 fs-6">
                            <i class="bi bi-patch-check-fill me-1"></i>Accredited
                        </span>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="fw-bold mb-4 text-warning">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none fs-5"><i class="bi bi-chevron-right me-2"></i>About</a></li>
                        <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none fs-5"><i class="bi bi-chevron-right me-2"></i>Programs</a></li>
                        <li class="mb-3"><a href="{{ route('register') }}" class="text-white-50 text-decoration-none fs-5"><i class="bi bi-chevron-right me-2"></i>Apply</a></li>
                        <li class="mb-3"><a href="#" class="text-white-50 text-decoration-none fs-5"><i class="bi bi-chevron-right me-2"></i>Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h5 class="fw-bold mb-4 text-warning">Contact</h5>
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-geo-alt-fill text-warning fs-4 me-3"></i>
                        <span class="text-white-50 fs-5">Gwadar, Balochistan</span>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-envelope-fill text-warning fs-4 me-3"></i>
                        <span class="text-white-50 fs-5">admissions@ug.edu.pk</span>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="bi bi-telephone-fill text-warning fs-4 me-3"></i>
                        <span class="text-white-50 fs-5">+92-XXX-XXXXXXX</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-4 text-warning">Follow Us</h5>
                    <div class="d-flex gap-3 mb-4">
                        <a href="#" class="btn btn-outline-light btn-lg rounded-circle">
                            <i class="bi bi-facebook fs-4"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg rounded-circle">
                            <i class="bi bi-twitter fs-4"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg rounded-circle">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg rounded-circle">
                            <i class="bi bi-linkedin fs-4"></i>
                        </a>
                    </div>
                    <p class="text-white-50">Stay connected for updates and announcements</p>
                </div>
            </div>
            <hr class="border-secondary my-5">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-white-50 mb-0 fs-5">&copy; 2025 University of Gwadar. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 fs-5">
                        <span class="text-white-50">Developed by </span>
                        <span class="text-warning fw-bold">Sameer Ali, Waqas & Muhammad Ali</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>