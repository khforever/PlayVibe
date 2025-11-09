@extends('layouts.dashboard.app')



@section('title', $product->name)








@section('content')





<div class="app-content content">










    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white rounded-2xl shadow-xl p-8">






            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0"> {{ $product->name }} </h4>
                <a href="{{ route('products.index') }} " class="btn btn-primary">
                    ← Back to Products
                </a>


            </div>





            <!-- معرض صور المنتج -->
            <div class="col-md-3 mb-4 ml-4">
                @if($images->count() > 0)
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($images as $key => $img)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset($img->image_url) }}" class="d-block w-100 rounded shadow"
                                alt="Product image {{ $key + 1 }}">
                        </div>
                        @endforeach
                    </div>

                    @if($images->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                    @endif
                </div>
                @else
                <img src="{{ asset('assets/dashboard/products/default.jpg') }}" class="img-fluid rounded shadow"
                    alt="No image">
                @endif
            </div>

            {{-- end image --}}






            {{-- --}}

            <table class="table table-striped table-hover" dir="ltr">
                <tbody>





                    <tr>
                        <th scope="row">



                            <h1 class="text-3xl font-bold text-gray-800 mb-3">


                                Product Name
                            </h1>

                        </th>
                        <td>

                            <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $product->name }}</h1>


                        </td>


                    </tr>









                    <tr>
                        <th scope="row">


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">

                                Price
                            </h1>

                        </th>
                        <td>


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">


                                {{-- {{ $product->price }} --}}

                                {{ number_format($product->price, 2) }} $

                            </h1>


                        </td>
                    </tr>




                    <tr>
                        <th scope="row">


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">

                                Description
                            </h1>

                        </th>
                        <td>


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $product->description }}</h1>


                        </td>
                    </tr>








                    <tr>
                        <th scope="row">


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">

                                Category
                            </h1>

                        </th>
                        <td>


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">



                                {{$product->subCategory->category->name}}
                        </td>
                        </h1>


                        </td>
                    </tr>






                    {{-- --}}

                    <tr>
                        <th scope="row">


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">

                                SubCategory
                            </h1>

                        </th>
                        <td>


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">



                                {{$product->subCategory->name}}
                        </td>
                        </h1>


                        </td>
                    </tr>





                    <tr>




                        <th scope="row">


                            <h1 class="text-3xl font-bold text-gray-800 mb-3">

                                Main Image
                            </h1>

                        </th>


                        <td>


                            <!-- Product Image -->




                            @if ($product->mainImage && $product->mainImage->image_url)
                            <img src="{{ asset($product->mainImage->image_url) }}" width="80" height="80"
                                style="object-fit:cover; border-radius:8px;">
                            @else
                            <span class="text-muted">No image</span>
                            @endif
                        </td>












                        </td>







                </tbody>
            </table>




            {{-- show other attributes data -----------------------------------------------------}}








            <div class="col-md-10 mb-4 ml-4">
                @if($attributes->count() > 0)
                @foreach($attributes as $key => $attribute)
                <table class="table table-bordered w-75 mx-auto mb-5" dir="ltr">
                    <thead class="table-dark">
                        <tr>
                            <th colspan="2" class="text-center">
                                <h2 class="text-2xl font-bold text-white mb-0">
                                    Attribute this product
                                </h2>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <h1 class="text-3xl font-bold text-danger mb-3">The sum thumb:</h1>
                            </th>
                            <td>
                                <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $attribute->sumthumb }}</h1>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <h1 class="text-3xl font-bold text-danger mb-3">Additional Info:</h1>
                            </th>
                            <td>
                                <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $attribute->additional_info }}</h1>
                            </td>
                        </tr>

                        {{-- <tr>
                            <th scope="row">
                                <h1 class="text-3xl font-bold text-danger mb-3">Dimension:</h1>
                            </th>
                            <td>
                                <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $attribute->diminsion }}</h1>
                            </td>
                        </tr> --}}

                        <tr>
                            <th scope="row">
                                <h1 class="text-3xl font-bold text-danger mb-3">Main Compartment:</h1>
                            </th>
                            <td>
                                <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $attribute->maincompartment }}</h1>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <h1 class="text-3xl font-bold text-danger mb-3">Durable Fabric:</h1>
                            </th>
                            <td>
                                <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $attribute->durable_fabric }}</h1>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <h1 class="text-3xl font-bold text-danger mb-3">Spacious:</h1>
                            </th>
                            <td>
                                <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $attribute->spacious }}</h1>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <span class="text-muted">No Attributes</span>
                @endif
            </div>



            {{-- ////////////////////////////////////////////////////////////////////////////// --}}




            <!-- Product Details -->




            {{-- <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <div class="flex space-x-4 items-center">
                    <input type="number" name="quantity" min="1" value="1"
                        class="border rounded-xl w-20 px-3 py-2 text-center focus:ring focus:ring-green-300">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl shadow-lg transition-all">
                        <i class="fa fa-cart-plus mr-2"></i> Add to Cart
                    </button>
                </div>
            </form> --}}

































            <!-- Back Button -->

        </div>
    </div>

    <!-- Similar Products -->





</div>


</div>
@endsection
