@extends('layouts.dashboard.app')

  @section('title')
add Subcategory

@endsection


@section('content')

<div class ="app-content content">

 <div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-colored-form-control">Add Subcategory</h4>
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
          <h2>Subcategory Form</h2>
          <p>Fill out the details below to create a new subcategory.</p>
        </div>

        <form class="form" action="{{route('subcategory.store')}}" method="POST" enctype="multipart/form-data" style="direction: ltr; text-align: left;">
          @csrf

          <div class="form-body">
            <h4 class="form-section"><i class="la la-list"></i> Subcategory Information</h4>

            <div class="row">
              {{-- Select Category --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category_id">Select Category</label>
                  <select class="form-control border-primary" id="category_id" name="category_id" required>
                    <option value="">-- Choose Category --</option>
                     @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              {{-- Subcategory Name --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Subcategory Name</label>
                  <input type="text" id="name" class="form-control border-primary" name="name"  value = "{{old('name')}}"placeholder="Enter subcategory name" required>
               @error('name')
                <div class="alert alert-warning">{{$message}}</div>
            @enderror
                </div>
              </div>
            </div>

            {{-- Image Upload --}}
            <div class="form-group">
              <label for="image">Subcategory Image</label>
              <input type="file" id="image" class="form-control border-primary" name="image" accept="image/*">
              @error('image')
                <div class="alert alert-warning">{{$message}}</div>
            @enderror
              <small class="text-muted">Optional — upload an image for this subcategory.</small>
            </div>

          </div>

          <div class="form-actions">
            <button type="reset" class="btn btn-warning mr-1">
              <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="la la-check-square-o"></i> Add Subcategory
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>


</div>


@endsection
