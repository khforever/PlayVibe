<div class="col-12 mb-2">
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert">✖</button>
        </div>
    @endif
</div>
