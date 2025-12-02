@extends('layouts.dashboard.app')

@section('title')
Comments & Review
@endsection

@section('content')
<div class="app-content content">
    <!-- Column rendering table -->
    <section id="column">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Column rendering</h4>
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
                            <table class="table table-striped table-bordered column-rendering">
                                <h1>Comments & Review Details</h1>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Comments</th>
                                        <th>Rating</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @forelse ($reviews as $review )
                                             <td>{{$review->user->first_name}} {{$review->user->last_name }}</td>
                                           <td>{{$review->comment ?? 'No comment'}}</td>
                                         <td>{{$review->rating}} ★</td>
                                        <td> <form action="{{ route('comments.destroy', $review->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-transparent cursor-pointer border-0 ">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="48"
                                                                height="48" viewBox="0 0 48 48">
                                                                <g fill="none" stroke-linejoin="round"
                                                                    stroke-width="4">
                                                                    <path fill="#ff2f51" stroke="#000"
                                                                        d="M9 10V44H39V10H9Z" />
                                                                    <path stroke="#fff" stroke-linecap="round"
                                                                        d="M20 20V33" />
                                                                    <path stroke="#fff" stroke-linecap="round"
                                                                        d="M28 20V33" />
                                                                    <path stroke="#000" stroke-linecap="round"
                                                                        d="M4 10H44" />
                                                                    <path fill="#ff2f51" stroke="#000"
                                                                        d="M16 10L19.289 4H28.7771L32 10H16Z" />
                                                                </g>
                                                            </svg>
                                                        </button>
                                                    </form></td> 
                                        @empty
                                              <p class="text-center text-muted" style="font-size: 16px; padding: 15px;">
                                                                    No Reviews added yet.
                                                                </p>
                                        @endforelse
                                      
                                    </tr>
                                </tbody>
                            </table>

                          

                          

       
    </section>
    <!-- Column rendering table -->
</div>

@endsection
