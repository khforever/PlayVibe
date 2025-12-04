@extends('layouts.dashboard.app')

@section('title')
Add New SubCategory
@endsection

@section('content')
<div class="app-content content">
    <section id="add-category">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New SubCategory</h4>
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
                            <form class="form" method="POST" action="{{ route('subcategory.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-list"></i>SubCategory Information</h4>

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

                                    {{-- SubCategory Name --}}
                                    <div class="form-group">
                                        <label for="categoryName">Name SubCategory </label>
                                        <input type="text" id="categoryName" value="{{ old('name') }}" class="form-control" placeholder="Enter category name" name="name" >
                                         @error('name')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>

                                    {{-- SubCategory Image --}}
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
                                <a  class="btn btn-warning mr-1" href="{{route('subcategory.index')}}"> <i class="ft-x" ></i> Cancel
                                </a>


                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Create
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
