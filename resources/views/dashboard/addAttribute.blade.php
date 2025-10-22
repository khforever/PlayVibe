@extends('layouts.dashboard.app')

  @section('title')
form

@endsection


@section('content')

<div class ="app-content content">

 <div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title" id="basic-layout-colored-form-control">Product Attributes</h4>
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
          <p><h2>Product Attributes Form</h2></p>
        </div>

        <form class="form" action="" method="POST" enctype="multipart/form-data" style="direction: ltr; text-align: left;">
          @csrf
          <div class="form-body">
            <h4 class="form-section"><i class="la la-cube"></i> Attribute Details</h4>

            {{-- Product Selection --}}
            <div class="form-group">
              <label for="product_id">Select Product</label>
              <select id="product_id" name="product_id" class="form-control border-primary" required>
                <option value="">-- Choose Product --</option>
                {{-- @foreach($products as $product)
                  <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach --}}
              </select>
            </div>

            {{-- Sumthumb --}}
            <div class="form-group">
              <label for="sumthumb">Thumbnail Image</label>
              <input type="file" id="sumthumb" name="sumthumb" class="form-control border-primary">
            </div>

            {{-- Additional Info --}}
            <div class="form-group">
              <label for="additional_info">Additional Information</label>
              <textarea id="additional_info" name="additional_info" rows="3" class="form-control border-primary" placeholder="Write any extra info..."></textarea>
            </div>

            {{-- Dimension --}}
            <div class="form-group">
              <label for="dimension">Dimension</label>
              <input type="text" id="dimension" name="dimension" class="form-control border-primary" placeholder="e.g. 40x20x15 cm">
            </div>

            {{-- Main Compartment --}}
            <div class="form-group">
              <label for="maincompartment">Main Compartment</label>
              <input type="text" id="maincompartment" name="maincompartment" class="form-control border-primary" placeholder="e.g. One large compartment">
            </div>

            {{-- Durable Fabric --}}
            <div class="form-group">
              <label for="durable_fabric">Durable Fabric</label>
              <input type="text" id="durable_fabric" name="durable_fabric" class="form-control border-primary" placeholder="e.g. Waterproof nylon">
            </div>

            {{-- Spacious --}}
            <div class="form-group">
              <label for="spacious">Spacious</label>
              <input type="text" id="spacious" name="spacious" class="form-control border-primary" placeholder="e.g. Fits 15-inch laptop">
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
