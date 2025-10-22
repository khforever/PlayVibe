@extends('layouts.dashboard.app')

  @section('title')
form

@endsection


@section('content')

<div class ="app-content content">

<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-colored-form-control">Product Form</h4>
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
          <p><h2>Add New Product</h2></p>
        </div>

        <form class="form" action="" method="POST" style="direction: ltr; text-align: left;">
          @csrf
          <div class="form-body">
            <h4 class="form-section"><i class="la la-cube"></i> Product Information</h4>

            {{-- Product Name --}}
            <div class="form-group">
              <label for="name">Product Name</label>
              <input type="text" id="name" name="name" class="form-control border-primary" placeholder="Enter product name" required>
            </div>

            {{-- Subcategory --}}
            <div class="form-group">
              <label for="sub_category_id">Subcategory</label>
              <select id="sub_category_id" name="sub_category_id" class="form-control border-primary" required>
                <option value="">-- Select Subcategory --</option>
                {{-- @foreach ($subcategories as $subcategory)
                  <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach --}}
              </select>
            </div>

            {{-- Description --}}
            <div class="form-group">
              <label for="description">Description</label>
              <textarea id="description" name="description" rows="4" class="form-control border-primary" placeholder="Enter product description"></textarea>
            </div>

            {{-- Price --}}
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" step="0.01" id="price" name="price" class="form-control border-primary" placeholder="Enter product price" required>
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
