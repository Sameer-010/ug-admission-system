@extends('layouts.app')

@section('title', 'Welcome - UG Admission System')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-primary">University of Gwadar</h1>
                <h2 class="display-6">Online Admission Management System</h2>
                <p class="lead mt-3">Apply for your desired program online with ease</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-pencil-square fs-1 text-primary mb-3"></i>
                            <h5 class="card-title">Easy Application</h5>
                            <p class="card-text">Fill out your application form online from anywhere</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-file-earmark-check fs-1 text-success mb-3"></i>
                            <h5 class="card-title">Track Status</h5>
                            <p class="card-text">Monitor your application status in real-time</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-bell fs-1 text-warning mb-3"></i>
                            <h5 class="card-title">Get Notified</h5>
                            <p class="card-text">Receive email updates about your application</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="/register" class="btn btn-primary btn-lg px-5">Apply Now</a>
                <a href="/login" class="btn btn-outline-primary btn-lg px-5 ms-3">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection