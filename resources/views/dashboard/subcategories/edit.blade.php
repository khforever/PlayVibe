@extends('layouts.dashboard.app')

@section('title')
Update SubCategory
@endsection

@section('content')
<div class="app-content content">
    <section id="add-category">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update SubCategory</h4>
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
                            <form class="form" method="POST" action="{{route('subcategory.update',$subcategory->id)}}" enctype="multipart/form-data">
                                @csrf
                                  @Method('put')
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
                      <option value="{{$category->id}}"@selected(old('category_id', $subcategory->category_id) == $category->id)>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

                         {{-- Subcategory Name --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Subcategory Name</label>
                  <input type="text" id="name" class="form-control border-primary" name="name"  value = "{{old('name',$subcategory->name)}}"placeholder="Enter subcategory name" required>
               @error('name')
                <div class="alert alert-warning">{{$message}}</div>
            @enderror
                </div>
              </div>
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
                                    <button type="reset" class="btn btn-warning mr-1">
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
