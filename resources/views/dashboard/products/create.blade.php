@extends('layouts.dashboard.app')

@section('title')
Add Product
@endsection

@section('content')
<div class="app-content content">
    <section id="add-product">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Product</h4>
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
                            <div class="card-text mb-2">
                                   @if (session()->has('errors'))
              <div class="alert alert-danger">
                @foreach (session('errors')->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </div>
          @endif
                                <h2>Product Information Form</h2>
                                <p>Enter product details below.</p>
                            </div>

                            <form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" style="direction: ltr; text-align: left;">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-cube"></i> Product Details</h4>

                                    {{-- Product Name --}}
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" id="name" name="name" class="form-control border-primary" placeholder="Enter product name" >
                                    </div>

                                    {{-- Description --}}
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="form-control border-primary" rows="3" placeholder="Enter product description"></textarea>
                                    </div>

                                    {{-- Price --}}
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" name="price" step="0.01" class="form-control border-primary" placeholder="Enter price" required>
                                    </div>

                                    {{-- Sub Category --}}
                                    <div class="form-group">
                                        <label for="sub_category_id">Category-Subcategory</label>
                                        <select id="sub_category_id" name="sub_category_id" class="form-control border-primary" required>
                                            <option value="">-- Select Subcategory --</option>
                                            {{-- Dynamically load subcategories here --}}
                                            @foreach ($subCategories as $subCategory)

                                            <option value="{{ $subCategory->id }}"> {{ $subCategory->category->name }} — {{ $subCategory->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
               <input type="file" id="productImage" class="form-control mb-2" accept="image/*" multiple name="images[]"/>
                  <div class="tn-slider mb-2">
                      <div id="imagePreview" class="slick-slider"></div>
                  </div>



                                </div>

                              <div class="form-actions">
                                <a  class="btn btn-warning mr-1" href="{{route('products.index')}}"> <i class="ft-x" ></i> Cancel
                                </a>
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
    </section>
</div>
@endsection
@push('js')
<script>
$(document).ready(function() {
    // initialize with defaults
    $("#productImage").fileinput({
         theme: 'fa5',
          showCancel: true,
          showUpload:false,
          maxFileCount:5,
    });

    // with plugin options
    $("#productImage").fileinput({'uploadUrl': '/path/to/your-upload-api', 'previewFileType': 'any'});

});
</script>
@endpush
