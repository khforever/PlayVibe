@extends('layouts.dashboard.app')

@section('title')
Edit Category
@endsection

@section('content')
<div class="app-content content">
    <section id="edit-category">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Category Information</h4>
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
                            <form class="form" method="POST" action="{{route('categories.update',$category->id)}}" enctype="multipart/form-data">
                               @csrf
                               @method('PUT')
                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-list"></i> Category Details</h4>

                                    {{-- Category Name --}}
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" id="categoryName" value="{{$category->name}}" class="form-control" name="name" placeholder="Enter category name" value="Electronics">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Category Image --}}
                                    <div class="form-group">
                                        <label for="categoryImage">Category Image</label>
                                        <input type="file" id="categoryImage" class="form-control-file" name="image">
                                        <div class="mt-2">
                                            <p>Current Image:</p>
                                            <img src="{{ asset('assets/dashboard/categories/'.$category->image.'') }}" alt="Category Image" width="120" class="rounded border shadow-sm">
                                        </div>
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
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
