@extends('layouts.app')

@section('header')
    <h2 class="fw-bold fs-4 text-dark">Profile</h2>
@endsection

@section('content')

<div class="row g-4">

    <div class="col-md-8 mx-auto">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="col-md-8 mx-auto">
        @include('profile.partials.update-password-form')
    </div>

    <div class="col-md-8 mx-auto">
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection
