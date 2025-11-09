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
                        <h4 class="card-title">Add attribute</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

<h1 style="font-weight: bold; color: red;  text-align: center;">Add Attribute for: {{ $product->name }}</h1> 

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="card-text mb-2">
                                <h2>Product Information Form</h2>
                                <p>Enter product details below.</p>
                            </div>

                            <form class="form" action="{{ route('attributes.store',$product->id) }}" method="POST" enctype="multipart/form-data" style="direction: ltr; text-align: left;">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-cube"></i> Product attributes</h4>

                                    {{-- <div class="form-group">
                                        <label for="product_id">product name</label>
                                        <select id="product_id" name="product_id" class="form-control border-primary" required>
                                            <option value="">-- Select product --</option>

                                            @foreach ($products as $product)

                                            <option value="{{ $product->id }}">{{ $product->name }}</option>

                                            @endforeach
                                        </select>
                                    </div> --}}


                                    <div class="form-group">
                                        <label for="name">sumthumb</label>
                                        <input type="text" id="name" name="sumthumb" class="form-control border-primary" placeholder="Enter sumthumb " value ="{{old('sumthumb')}}">
                                         @error('sumthumb')
                                        <div class="alert alert-warning">{{$message}}</div>
                                         @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="description">additional_info</label>
                                         <input type="text" id="name" name="additional_info" class="form-control border-primary" placeholder="Enter additional_info "  value ="{{old('additional_info')}}">
                                          @error('additional_info')
                                        <div class="alert alert-warning">{{$message}}</div>
                                         @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="dimension">dimension</label>
                                        <input type="text" id="price" name="dimension" step="0.01" class="form-control border-primary" placeholder="Enter dimension" value ="{{old('dimension')}}" required>
                                         @error('dimension')
                                        <div class="alert alert-warning">{{$message}}</div>
                                         @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="maincompartment">maincompartment</label>
                                        <input type="text" id="maincompartment" name="maincompartment" step="0.01" class="form-control border-primary" placeholder="Enter maincompartment " value ="{{old('maincompartment')}}" required>
                                         @error('maincompartment')
                                        <div class="alert alert-warning">{{$message}}</div>
                                         @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="durable_fabric">durable_fabric</label>
                                        <input type="text" id="durable_fabric" name="durable_fabric" step="0.01" class="form-control border-primary" placeholder="Enter durable_fabric"  value ="{{old('durable_fabric')}}" required>
                                         @error('durable_fabric')
                                        <div class="alert alert-warning">{{$message}}</div>
                                         @enderror
                                    </div>

                                <div class="form-group">
                                        <label for="durable_fabric">spacious</label>
                                        <input type="text" id="spacious" name="spacious" step="0.01" class="form-control border-primary" placeholder="Enter spacious" value ="{{old('spacious')}}" required>
                                         @error('durable_fabric')
                                        <div class="alert alert-warning">{{$message}}</div>
                                         @enderror
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
