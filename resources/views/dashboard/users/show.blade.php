 @extends('layouts.dashboard.app')

@section('title')
Show User
@endsection

@section('content')
<div class="app-content content">
    <section id="edit-user">
        <div class="row">
            <div class="col-md-8 offset-md-2">


                <a href="{{ route('users.index') }}" class="btn btn-primary mb-3">
                                <i class="fa fa-arrow-left"></i> Back to  Users
                            </a>


                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Show User Information</h4>
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
                            <form class="form" method="POST" action="#">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-user"></i> User Details</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">First Name</label>
                                                <input type="text" id="firstName" class="form-control" placeholder="Enter first name" name="first_name"


                                                value="{{ $user->first_name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" id="lastName" class="form-control"
                                                 placeholder="Enter last name" name="last_name" value="{{ $user->last_name }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control" placeholder="Enter email"
                                                 name="email" value="{{ $user->email }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" id="phone" class="form-control" placeholder="Enter phone number"
                                                name="phone" value="{{ $user->phone}}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" id="city" class="form-control"
                                                placeholder="Enter city" name="city" value="{{ $user->city }}" readonly>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">User Role</label>
                                                <select id="role" class="form-control" name="role">
                                                    <option value="Admin" selected>Admin</option>
                                                    <option value="User">User</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                    </div>



          {{-- Current & New Image --}}
                                    {{-- <div class="form-group">
                                        <label>  Profile Image</label>
                                        <div class="mb-2">
                                            @if($user->image)
                                                <img src="{{  $user->image }}" alt="User Image"
                                                     class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                            @else
                                                <p class="text-muted">No image uploaded</p>
                                            @endif
                                        </div>
                                    </div> --}}



{{--
                                    <div class="form-group">
                                        <label for="userImage">Profile Image</label>
                                        <input type="file" id="userImage" class="form-control-file" name="image">
                                    </div> --}}
                                </div>

                                <div class="form-actions">

{{--
                                    <button type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> Cancel
                                    </button> --}}

{{--
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Update
                                    </button>
 --}}


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
