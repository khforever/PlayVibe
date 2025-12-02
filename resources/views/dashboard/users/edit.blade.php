@extends('layouts.dashboard.app')

@section('title')
Edit User
@endsection

@section('content')
<div class="app-content content">
    <section id="edit-user">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit User</h4>
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

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="form" method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-user"></i> User Details</h4>

                                    {{-- First & Last Name --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">First Name <span class="text-danger">*</span></label>
                                                <input type="text" id="firstName" class="form-control @error('first_name') is-invalid @enderror"
                                                       placeholder="Enter first name" name="first_name"
                                                       value="{{ old('first_name', $user->first_name) }}" required>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" id="lastName" class="form-control @error('last_name') is-invalid @enderror"
                                                       placeholder="Enter last name" name="last_name"
                                                       value="{{ old('last_name', $user->last_name) }}" required>
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
                                                       placeholder="Enter email" name="email"
                                                       value="{{ old('email', $user->email) }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                                       placeholder="Enter phone number" name="phone"
                                                       value="{{ old('phone', $user->phone) }}">
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
                                                       placeholder="Enter address" name="address"
                                                       value="{{ old('address', $user->address) }}">
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" id="city" class="form-control @error('city') is-invalid @enderror"
                                                       placeholder="Enter city" name="city"
                                                       value="{{ old('city', $user->city) }}">
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Password Section --}}
                                    <h4 class="form-section"><i class="la la-lock"></i> Change Password (Optional)</h4>
                                    <div class="alert alert-info">
                                        <i class="la la-info-circle"></i> Leave password fields empty if you don't want to change the password.
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                                       placeholder="Enter new password" name="password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">Minimum 8 characters</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm New Password</label>
                                                <input type="password" id="password_confirmation" class="form-control"
                                                       placeholder="Confirm new password" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- User Role & Verification Status --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">User Role <span class="text-danger">*</span></label>
                                                <select id="role" class="form-control @error('user_type') is-invalid @enderror" name="user_type" required>
                                                    <option value="1" {{ old('user_type', $user->user_type) == 1 ? 'selected' : '' }}>Admin</option>
                                                    <option value="2" {{ old('user_type', $user->user_type) == 2 ? 'selected' : '' }}>User</option>
                                                </select>
                                                @error('user_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="is_verified">Verification Status</label>
                                                <select id="is_verified" class="form-control @error('is_verified') is-invalid @enderror" name="is_verified">
                                                    <option value="0" {{ old('is_verified', $user->is_verified) == 0 ? 'selected' : '' }}>Not Verified</option>
                                                    <option value="1" {{ old('is_verified', $user->is_verified) == 1 ? 'selected' : '' }}>Verified</option>
                                                </select>
                                                @error('is_verified')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Current & New Image --}}
                                    <div class="form-group">
                                        <label>Current Profile Image</label>
                                        <div class="mb-2">
                                            @if($user->image)
                                                <img src="{{  $user->image }}" alt="User Image"
                                                     class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                            @else
                                                <p class="text-muted">No image uploaded</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="userImage">Change Profile Image</label>
                                        <input type="file" id="userImage" class="form-control-file @error('image') is-invalid @enderror"
                                               name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF (Max: 2MB). Leave empty to keep current image.</small>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <a href="{{ route('users.index') }}" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Update
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
