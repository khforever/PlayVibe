@extends('layouts.dashboard.app')

  @section('title')
form

@endsection


@section('content')

<div class ="app-content content">

<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-colored-form-control">User Profile</h4>
      <div class="heading-elements">
        <ul class="list-inline mb-0">
          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
          <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
          <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
        </ul>
      </div>
    </div>

    <div class="card-content collapse show">
      <div class="card-body">
        <div class="card-text">
          <p><h2>User Registration Form</h2></p>
        </div>

        <form class="form" action=" " method="POST" enctype="multipart/form-data" style="direction: ltr; text-align: left;">
          @csrf
          <div class="form-body">
            <h4 class="form-section"><i class="la la-user"></i> Personal Information</h4>

            <div class="row">
              {{-- First Name --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" id="first_name" class="form-control border-primary" placeholder="Enter first name" name="first_name" required>
                </div>
              </div>

              {{-- Last Name --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" id="last_name" class="form-control border-primary" placeholder="Enter last name" name="last_name" required>
                </div>
              </div>
            </div>

            <div class="row">
              {{-- Email --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control border-primary" placeholder="Enter email address" name="email" required>
                </div>
              </div>

              {{-- Password --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" id="password" class="form-control border-primary" placeholder="Enter password" name="password" required>
                </div>
              </div>
            </div>

            <h4 class="form-section"><i class="ft-phone"></i> Contact Info</h4>

            <div class="row">
              {{-- Phone --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="tel" id="phone" class="form-control border-primary" placeholder="Enter phone number" name="phone">
                </div>
              </div>

              {{-- City --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" id="city" class="form-control border-primary" placeholder="Enter city" name="city">
                </div>
              </div>
            </div>

            {{-- Address --}}
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" id="address" class="form-control border-primary" placeholder="Enter address" name="address">
            </div>

            <h4 class="form-section"><i class="la la-cog"></i> Account Settings</h4>

            <div class="row">
              {{-- User Type --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="user_type">User Type</label>
                  <select id="user_type" name="user_type" class="form-control border-primary">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                  </select>
                </div>
              </div>

              {{-- Verified --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="is_verified">Verified</label>
                  <select id="is_verified" name="is_verified" class="form-control border-primary">
                    <option value="0" selected>No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
              </div>
            </div>

            {{-- Image --}}
            <div class="form-group">
              <label for="image">Profile Image</label>
              <input type="file" id="image" name="image" class="form-control border-primary">
            </div>
          </div>

          <div class="form-actions">
            <button type="reset" class="btn btn-warning mr-1">
              <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="la la-check-square-o"></i> Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


</div>


@endsection
