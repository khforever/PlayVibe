@extends('layouts.dashboard.auth')
@section('title')
table title

@endsection


@section('content')
 

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="{{asset('assets/dashboard')}}/images/logo/logo-dark.png" alt="branding logo">
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Create Account</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal form-simple" method="POST" action="{{ route('register') }}" >
                       @csrf
                      <fieldset class="form-group position-relative has-icon-left mb-1">
                        <input type="text" class="form-control form-control-lg input-lg" id="user-name"  name="first_name" value="{{ old('first_name') }}"  placeholder="First Name">
                      
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                          <small class="text-danger">
                            @error('first_name')
                            {{ $message }}
                            @enderror
                          </small>
                        
                      </fieldset>
                        <fieldset class="form-group position-relative has-icon-left mb-1">
                        <input type="text" class="form-control form-control-lg input-lg" id="user-name"  name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                         @error('last_name')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left mb-1">
                        <input type="email" class="form-control form-control-lg input-lg" id="user-email"
                        placeholder="Your Email Address" name="email" value="{{ old('email') }}" required>
                        @error('email')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                        
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg input-lg" id="user-password"
                        placeholder="Enter Password"  name="password" required>
                         @error('password')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                         <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg input-lg" id="user-password"
                        placeholder="Enter Confirm Password"  name="password_confirmation" required>
                         @error('password_confirmation')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Register</button>
                    </form>
                  </div>
                  <p class="text-center">Already have an account ? <a href="{{ route('login') }}" class="card-link">Login</a></p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
 



@endsection

