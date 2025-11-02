@extends('layouts.dashboard.app')

@section('title')
Deleted Users
@endsection

@section('content')



  @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif






<div class="app-content content">






    <!-- Users Table -->
    <section id="users-table">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users List</h4>
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
                        <div class="card-body card-dashboard">
                            <p class="card-text">All registered users in the system</p>
<a href="{{ route('users.index') }}" class="btn btn-primary mb-3">
        <i class="fa fa-arrow-left"></i> Back to Active Users
    </a>


                            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>
                            <table class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Verified</th>
                                        <th>User Type</th>
 <th>Restore</th>
                                        <th>Update</th>



                                         <th>Deleted At</th>

                                    </tr>
                                </thead>

                                <tbody>

 @foreach ($trashedUsers as $user)





                                    <tr>
                                        <td><img src="images/user1.jpg" alt="User Image" width="50" class="rounded-circle"></td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                           <td>{{ $user->email }}</td>
                                        <td>01012345678</td>
                                        <td>Cairo</td>
                                        <td><span class="badge badge-success">Yes</span></td>
                                        <td>{{ $user->user_type == 1 ? 'Admin' : 'User' }}</td>
<td>
    {{-- زر Restore فقط --}}
    <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-success btn-sm">
            <i class="fa fa-undo"></i> Restore
        </button>
    </form>
</td>


                                        <td>
   <a href="{{ route('users.edit', $user->id) }}">



    Edit</a>


                                            <!-- Update SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32">
                                                <g fill="none">
                                                    <path fill="#b3e0ff" d="m29 20l-9 9H7.5A4.5 4.5 0 0 1 3 24.5V10l13-1l13 1z"/>
                                                    <path fill="#0094f0" d="M3 7.5A4.5 4.5 0 0 1 7.5 3h17A4.5 4.5 0 0 1 29 7.5V10H3z"/>
                                                </g>
                                            </svg>
                                        </td>































<td>{{ $user->deleted_at->format('Y-m-d H:i') }}</td>

<td>
    {{-- زر Restore فقط --}}
    <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-success btn-sm">
            <i class="fa fa-undo"></i> Restore
        </button>
    </form>
</td>




 



                                    </tr>
 @endforeach

                                </tbody>


                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /Users Table -->

</div>
@endsection
