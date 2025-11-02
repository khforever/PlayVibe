@extends('layouts.dashboard.app')

@section('title')
Products
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
                                <h1>Product Details</h1>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Sub_Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->subCategory->name}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- Success & Error Messages --}}
                            @if(session('success'))
                                <div class="alert alert-success  mt-3 mx-auto text-center" style="width: 50%;">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))

                                <div class="alert alert-danger mt-3 mx-auto text-center" style="width: 50%;">{{ session('error') }}</div>
                            @endif

                            {{-- Add Variant Form --}}
                            <div class="card mt-4 mb-4">
                                <div class="card-body">
                                    <h5>Add New Variant</h5>
                                    <form action="{{ route('productVariants.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <div class="row align-items-end">
                                            <div class="col-md-4">
                                                <label for="color_id" class="form-label">Color</label>
                                                <div class="d-flex align-items-center">
                                                    <select name="color_id" id="color_id" class="form-control me-2 " style="width: 80%;">
                                                        <option value="">-- Select Color --</option>
                                                        @foreach($colors as $color)
                                                            <option value="{{ $color->id }}" data-code="{{ $color->code }}">
                                                                {{ $color->color }} :{{ $color->code }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <div id="color-preview" style="
                                                        width: 30px;
                                                        height: 30px;
                                                        margin-right: 10px;
                                                        border: 1px solid #ccc;
                                                        background-color: transparent;
                                                        border-radius: 6px;
                                                    "></div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="size_id" class="form-label">Size</label>
                                                <select name="size_id" id="size_id" class="form-control">
                                                    <option value="">-- Select Size --</option>
                                                    @foreach($sizes as $size)
                                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4 text-end">
                                                <button type="submit" class="btn btn-primary mt-4">Add Variant</button>
                                            </div>

                                            
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Variants List --}}
                            <h4>Existing Variants</h4>
                            @if($product->variants->count())
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product->variants as $variant)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($variant->color)
                                                        <span style="background-color: {{ $variant->color->code }};
                                                            padding: 5px 10px;
                                                            border: 1px solid #ccc;
                                                            border-radius: 6px;">
                                                            {{ $variant->color->color }}
                                                        </span>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $variant->size->size ?? 'N/A' }}</td>
                                                <td>
                                                    <form action="{{ route('productVariants.destroy', $variant->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No variants added yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Column rendering table -->
</div>

{{-- script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const colorSelect = document.getElementById('color_id');
    const preview = document.getElementById('color-preview');

    colorSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const colorCode = selectedOption.getAttribute('data-code');

        if (colorCode) {
            preview.style.backgroundColor = colorCode;
        } else {
            preview.style.backgroundColor = 'transparent';
        }
    });
});
</script>
@endsection
