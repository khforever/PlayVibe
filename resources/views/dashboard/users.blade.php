@extends('layouts.dashboard.app')

@section('title')
Users
@endsection

@section('content')
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
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><img src="images/user1.jpg" alt="User Image" width="50" class="rounded-circle"></td>
                                        <td>Kholoud Mohamed</td>
                                        <td>kholoud@example.com</td>
                                        <td>01012345678</td>
                                        <td>Cairo</td>
                                        <td><span class="badge badge-success">Yes</span></td>
                                        <td>Admin</td>
                                        <td>
                                            <!-- Update SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32">
                                                <g fill="none">
                                                    <path fill="#b3e0ff" d="m29 20l-9 9H7.5A4.5 4.5 0 0 1 3 24.5V10l13-1l13 1z"/>
                                                    <path fill="#0094f0" d="M3 7.5A4.5 4.5 0 0 1 7.5 3h17A4.5 4.5 0 0 1 29 7.5V10H3z"/>
                                                </g>
                                            </svg>
                                        </td>
                                        <td>
                                            <!-- Delete SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 48 48">
                                                <g fill="none" stroke-linejoin="round" stroke-width="4">
                                                    <path fill="#ff2f51" stroke="#000" d="M9 10V44H39V10H9Z"/>
                                                    <path stroke="#fff" stroke-linecap="round" d="M20 20V33"/>
                                                    <path stroke="#fff" stroke-linecap="round" d="M28 20V33"/>
                                                    <path stroke="#000" stroke-linecap="round" d="M4 10H44"/>
                                                    <path fill="#ff2f51" stroke="#000" d="M16 10L19.289 4H28.7771L32 10H16Z"/>
                                                </g>
                                            </svg>
                                        </td>
                                    </tr>

                                    <!-- Example Second Row -->
                                    <tr>
                                        <td><img src="images/user2.jpg" alt="User Image" width="50" class="rounded-circle"></td>
                                        <td>Ahmed Ali</td>
                                        <td>ahmed@gmail.com</td>
                                        <td>01122334455</td>
                                        <td>Giza</td>
                                        <td><span class="badge badge-danger">No</span></td>
                                        <td>User</td>
                                        <td>🖊️</td>
                                        <td>🗑️</td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Image</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Verified</th>
                                        <th>User Type</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
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
