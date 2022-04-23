<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-warning alert-dismissible show fade" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('error') }}
        </div>
    @endif
</div>
