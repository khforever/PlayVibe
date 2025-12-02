@extends('layouts.dashboard.app')

@section('title')
All Site siteReview

@endsection


@section('content')
<div class="app-content content  ">

<div class="container py-4">

        <h2 class="fw-bold text-center mb-2  ">All Site Reviews</h2>

@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert">✖</button>
        </div>
    @endif



    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>User</th>
                        <th>Rating</th>
                        <th>siteReview</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($siteReviews as $siteReview)
                    <tr>
                        <td class="fw-semibold">
                            {{ $siteReview->user->name ?? '— User Deleted —' }}
                        </td>

                        <td>
                            <span class="badge bg-primary ">
                                ⭐ {{ $siteReview->rating }}
                            </span>
                        </td>

                        <td style="max-width: 350px;">
                            {{ Str::limit($siteReview->review, 80) }}
                        </td>

                        <td>
                            @if($siteReview->is_approved)
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>

                        <td>

                                <form action="{{ route('site-reviews.approve', $siteReview->id) }}" method="POST">
                                    @csrf
                                   @if($siteReview->is_approved)
                                     <button class="btn btn-sm btn-warning w-100">
                                                             Mark as Pending
                                     </button>
                                        @else
                                      <button class="btn btn-sm btn-success w-100">
                                           Approve
                                        </button>
                                         @endif
                                </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $siteReviews->links() }}
    </div>

</div>


</div>
@endsection
