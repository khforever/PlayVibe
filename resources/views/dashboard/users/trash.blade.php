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


                            {{-- <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a> --}}
                            <table class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        {{-- <th>Image</th> --}}
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Verified</th>
                                        <th>Restore</th>
                                        <th>Deleted At</th>

                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($trashedUsers as $user)

                                    <tr>
                                         <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                      {{-- <td>
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image"
                                                width="50" height="50" class="rounded-circle"
                                                style="object-fit: cover;">
                                        </td> --}}

                                        <td>{{ $user->email }}</td>
                                        <td>{{$user->phone}}</td>

                                             <td><span class="badge badge-success">
                                            {{ $user->is_verified == 1 ? 'Yes' : 'No' }}</span></td>


                                        <td>

                                            <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="bg-transparent cursor-pointer border-0 " >




<svg width="35" height="35"    viewBox="-2 0 24 24" id="meteor-icon-kit__solid-undo" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.62132 7L7.06066 8.43934C7.64645 9.02513 7.64645 9.97487 7.06066 10.5607C6.47487 11.1464 5.52513 11.1464 4.93934 10.5607L0.93934 6.56066C0.35355 5.97487 0.35355 5.02513 0.93934 4.43934L4.93934 0.43934C5.52513 -0.146447 6.47487 -0.146447 7.06066 0.43934C7.64645 1.02513 7.64645 1.97487 7.06066 2.56066L5.62132 4H10C15.5228 4 20 8.47715 20 14C20 19.5228 15.5228 24 10 24C4.47715 24 0 19.5228 0 14C0 13.1716 0.67157 12.5 1.5 12.5C2.32843 12.5 3 13.1716 3 14C3 17.866 6.13401 21 10 21C13.866 21 17 17.866 17 14C17 10.134 13.866 7 10 7H5.62132z" fill="#758CA3"></path></g></svg>



















                                                </button>
                                            </form>
                                        </td>


                                        <td>{{ $user->deleted_at->format('Y-m-d H:i') }}</td>


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
