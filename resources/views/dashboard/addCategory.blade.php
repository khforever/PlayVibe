@extends('layouts.dashboard.app')

  @section('title')
form

@endsection


@section('content')

<div class ="app-content content">



 <div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-colored-form-control">Add Category</h4>
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
          <h2> category Form</h2>
          <p>Fill out the details below to create a new  category.</p>
        </div>

        <form class="form" action="" method="POST" enctype="multipart/form-data" style="direction: ltr; text-align: left;">
          @csrf

          <div class="form-body">
            <h4 class="form-section"><i class="la la-list"></i> category Information</h4>

            <div class="row">
           
              {{-- category Name --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">category Name</label>
                  <input type="text" id="name" class="form-control border-primary" name="name" placeholder="Enter category name" required>
                </div>
              </div>
            </div>

            {{-- Image Upload --}}
            <div class="form-group">
              <label for="image"> category Image</label>
              <input type="file" id="image" class="form-control border-primary" name="image" accept="image/*">
              <small class="text-muted">Optional — upload an image for this category.</small>
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
