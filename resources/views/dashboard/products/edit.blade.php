@extends('layouts.dashboard.app')

@section('title')
Edit Product
@endsection

@section('content')
<div class="app-content content">
    <section id="edit-product">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Product Information</h4>
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
                                <h2>Update Product Details</h2>
                                <p>Modify the information of the selected product below.</p>
                            </div>

                            <form class="form" method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-cube"></i> Product Information</h4>

                                    {{-- Product Name --}}
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" id="name" name="name" class="form-control border-primary"
                                            value="{{ $product->name }}"  >
                                    </div>

                                    {{-- Description --}}
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" rows="3" class="form-control border-primary"
                                            >{{ $product->description }}</textarea>
                                    </div>

                                    {{-- Price --}}
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" name="price" class="form-control border-primary"
                                            value="{{ $product->price }}" step="0.01" required>
                                    </div>

                                    {{-- Subcategory --}}
                                    <div class="form-group">
                                        <label for="sub_category_id">Subcategory</label>
                                        <select id="sub_category_id" name="sub_category_id" class="form-control border-primary" required>
                                            <option value="">-- Select Subcategory --</option>
                                            {{-- Dynamically load subcategories here --}}
                                            @foreach ($subCategories as $subCategory)

                                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Product Image --}}
                                    {{-- <div class="form-group">
                                        <label for="image">Product Image</label>
                                        <input type="file" id="image" name="image" class="form-control border-primary">
                                        <small class="form-text text-muted">Leave blank to keep the current image.</small>

                                        <div class="mt-1">
                                            <img src="/images/products/leather-handbag.jpg" alt="Current Image" width="100" class="rounded">
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="form-actions">
                                    <button type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Update
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
