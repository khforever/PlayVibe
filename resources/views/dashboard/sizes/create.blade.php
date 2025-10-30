@extends('layouts.dashboard.app')

@section('title')
Add New Size
@endsection

@section('content')
<div class="app-content content">
    <section id="add-category">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Size</h4>
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
                            <form class="form" method="POST" action="{{ route('sizes.store') }}" >
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-list"></i> Size Information</h4>

                                    {{-- Size Name --}}
                                    <div class="form-group">
                                        <label for="sizeName">Size Name</label>
                                        <input type="text" id="sizeName" value="{{ old('size') }}" class="form-control" placeholder="Enter size name" name="size" >
                                         @error('size')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="reset"  class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> Cancel
                                    </button>
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

