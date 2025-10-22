@extends('layouts.dashboard.app')

  @section('title')
form

@endsection


@section('content')

<div class ="app-content content">

<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-colored-form-control">Add Product Review</h4>
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
          <p><h2>Review Form</h2></p>
        </div>

        <form class="form" action="" method="POST" style="direction: ltr; text-align: left;">
          @csrf

          <div class="form-body">
            <h4 class="form-section"><i class="la la-comment"></i> Review Details</h4>

            {{-- User --}}
            <div class="form-group">
              <label for="user_id">Select User</label>
              <select id="user_id" name="user_id" class="form-control border-primary" required>
                <option value="">-- Select User --</option>
                {{-- @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                @endforeach --}}
              </select>
            </div>

            {{-- Product --}}
            <div class="form-group">
              <label for="product_id">Select Product</label>
              <select id="product_id" name="product_id" class="form-control border-primary" required>
                <option value="">-- Select Product --</option>
                {{-- @foreach ($products as $product)
                  <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach --}}
              </select>
            </div>

            {{-- Rating --}}
            <div class="form-group">
              <label for="rating">Rating</label>
              <select id="rating" name="rating" class="form-control border-primary" required>
                <option value="">-- Select Rating --</option>
                <option value="1">⭐ 1 - Poor</option>
                <option value="2">⭐⭐ 2 - Fair</option>
                <option value="3">⭐⭐⭐ 3 - Good</option>
                <option value="4">⭐⭐⭐⭐ 4 - Very Good</option>
                <option value="5">⭐⭐⭐⭐⭐ 5 - Excellent</option>
              </select>
            </div>

            {{-- Comment --}}
            <div class="form-group">
              <label for="comment">Comment</label>
              <textarea id="comment" name="comment" rows="4" class="form-control border-primary" placeholder="Write your review here..."></textarea>
            </div>
          </div>

          <div class="form-actions">
            <button type="reset" class="btn btn-warning mr-1">
              <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="la la-check-square-o"></i> Submit Review
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



</div>


@endsection
