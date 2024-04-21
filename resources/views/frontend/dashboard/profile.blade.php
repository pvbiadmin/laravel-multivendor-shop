@extends( 'frontend.dashboard.layouts.master' )

@section( 'title' )
    {{ $settings->site_name }} || Profile
@endsection

@section( 'content' )
    <!--=============================
    DASHBOARD START
  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include( 'frontend.dashboard.layouts.sidebar' )

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <h4>basic information</h4>
                                <form method="post" action="{{ route('user.profile.update') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method( 'PUT' )
                                    <div class="col-md-12">
                                        <div class="col-md-2 mb-4">
                                            <div class="wsus__dash_pro_img">
                                                <img src="{{
                                                    asset(Auth::user()->image
                                                        ?? 'frontend/images/profile-dark.svg' ) }}"
                                                     alt="img" class="img-fluid w-100">
                                                <input type="file" name="image">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie"></i>
                                                <input type="text" id="name" name="name" aria-label="name"
                                                       value="{{ Auth::user()->name }}" placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fal fa-envelope-open"></i>
                                                <input type="email" id="email" name="email" aria-label="email"
                                                       value="{{ Auth::user()->email }}" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <button class="common_btn mb-4 mt-2" type="submit">Update Profile</button>
                                    </div>
                                </form>

                                <hr>

                                <h4>change password</h4>

                                <form method="post" action="{{ route('user.profile.update.password') }}">
                                    @csrf
                                    <div class="wsus__dash_pass_change mt-2">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-unlock-alt"></i>
                                                    <input type="password" id="current_password" name="current_password"
                                                           aria-label="current_password" placeholder="Current Password">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-lock-alt"></i>
                                                    <input type="password" id="password" name="password"
                                                           aria-label="new_password" placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-lock-alt"></i>
                                                    <input type="password" id="password_confirmation"
                                                           name="password_confirmation"
                                                           aria-label="password_confirmation"
                                                           placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <button class="common_btn" type="submit">update password</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
      DASHBOARD START
    ==============================-->
@endsection
