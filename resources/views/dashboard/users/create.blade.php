@extends('layouts.dashboard.app')

@section('title')
Add New User
@endsection

@section('content')
<div class="app-content content">
    <section id="add-user">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New User</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-user-plus"></i> User Details</h4>

                                    {{-- First & Last Name --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">First Name <span class="text-danger">*</span></label>
                                                <input type="text" id="firstName" class="form-control @error('first_name') is-invalid @enderror"
                                                       placeholder="Enter first name" name="first_name" value="{{ old('first_name') }}" required>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" id="lastName" class="form-control @error('last_name') is-invalid @enderror"
                                                       placeholder="Enter last name" name="last_name" value="{{ old('last_name') }}" required>
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Email & Phone --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                                       placeholder="Enter email" name="email" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                                       placeholder="Enter phone number" name="phone" value="{{ old('phone') }}">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Address & City --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" class="form-control @error('address') is-invalid @enderror"
                                                       placeholder="Enter address" name="address" value="{{ old('address') }}">
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" id="city" class="form-control @error('city') is-invalid @enderror"
                                                       placeholder="Enter city" name="city" value="{{ old('city') }}">
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Password & Confirmation --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password <span class="text-danger">*</span></label>
                                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                                       placeholder="Enter password" name="password" required>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Minimum 8 characters</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                                <input type="password" id="password_confirmation" class="form-control"
                                                       placeholder="Confirm password" name="password_confirmation" required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- User Role --}}
                                    <div class="form-group">
                                        <label for="role">User Role <span class="text-danger">*</span></label>
                                        <select id="role" class="form-control @error('user_type') is-invalid @enderror" name="user_type" required>
                                            <option value="1" {{ old('user_type') == 1 ? 'selected' : '' }}>Admin</option>
                                            <option value="2" {{ old('user_type', 2) == 2 ? 'selected' : '' }}>User</option>
                                        </select>
                                        @error('user_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- User Image --}}
                                    <div class="form-group">
                                        <label for="userImage">Profile Image</label>
                                        <input type="file" id="userImage" class="form-control-file @error('image') is-invalid @enderror"
                                               name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF (Max: 2MB)</small>
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
    </section>
</div>
@endsection
