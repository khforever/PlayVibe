@extends('layouts.dashboard.app')

@section('title')
Add Attribute
@endsection

@section('content')
<div class="app-content content">
    <section id="add-attribute">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Attribute</h4>
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
                                <h2>Product Attribute Form</h2>
                                <p>Fill out the details below to add attributes for a product.</p>
                            </div>

                            <form class="form" action="" method="POST" enctype="multipart/form-data" style="direction: ltr; text-align: left;">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-cube"></i> Attribute Information</h4>

                                    {{-- Product Selection --}}
                                    <div class="form-group">
                                        <label for="product_id">Select Product</label>
                                        <select id="product_id" name="product_id" class="form-control border-primary" required>
                                            <option value="">-- Choose Product --</option>
                                            {{-- Dynamically load products here --}}
                                            <option value="1">Product 1</option>
                                            <option value="2">Product 2</option>
                                        </select>
                                    </div>

                                    {{-- Summary Thumbnail --}}
                                    <div class="form-group">
                                        <label for="sumthumb">Summary Thumbnail</label>
                                        <input type="text" id="sumthumb" name="sumthumb" class="form-control border-primary" placeholder="Enter summary thumbnail">
                                    </div>

                                    {{-- Additional Info --}}
                                    <div class="form-group">
                                        <label for="additional_info">Additional Info</label>
                                        <textarea id="additional_info" name="additional_info" class="form-control border-primary" rows="3" placeholder="Enter additional information"></textarea>
                                    </div>

                                    {{-- Dimension --}}
                                    <div class="form-group">
                                        <label for="dimension">Dimension</label>
                                        <input type="text" id="dimension" name="dimension" class="form-control border-primary" placeholder="Enter product dimensions">
                                    </div>

                                    {{-- Main Compartment --}}
                                    <div class="form-group">
                                        <label for="maincompartment">Main Compartment</label>
                                        <input type="text" id="maincompartment" name="maincompartment" class="form-control border-primary" placeholder="Describe main compartment">
                                    </div>

                                    {{-- Durable Fabric --}}
                                    <div class="form-group">
                                        <label for="durable_fabric">Durable Fabric</label>
                                        <input type="text" id="durable_fabric" name="durable_fabric" class="form-control border-primary" placeholder="Enter fabric type">
                                    </div>

                                    {{-- Spacious --}}
                                    <div class="form-group">
                                        <label for="spacious">Spacious</label>
                                        <input type="text" id="spacious" name="spacious" class="form-control border-primary" placeholder="Yes / No or short description">
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
    </section>
</div>
@endsection
