@extends('app')

@section('title', 'Profile')

@section('content')
    @include('layout.header')

    <div class="profile-page">
        <div class="container profile-content">
            <div class="profile">
                <div class="profile-image">
                    <img src="{{ asset('images/default-user.png') }}" alt="">
                </div>
                <div class="profile-user-settings">
                    <h3 class="profile-user-name">Lam Tam Nhu</h3>
                    <button class="btn profile-edit-btn">Edit Profile</button>
                    <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog"
                            aria-hidden="true"></i></button>
                </div>
                <div class="profile-stats">
                    <ul>
                        <li><span class="profile-stat-count">164</span> posts</li>
                        <li><span class="profile-stat-count">188</span> followers</li>
                        <li><span class="profile-stat-count">206</span> following</li>
                    </ul>
                </div>
                <div class="profile-bio">
                    <p><span class="profile-real-name">Lam Tam Nhu</span> Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit 📷✈️🏕️</p>
                </div>
            </div>
            <!-- End of profile section -->
        </div>

    </div>
    <!-- End of container -->
    </div>
@endsection
