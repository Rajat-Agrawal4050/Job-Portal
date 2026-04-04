@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
    <p>{{ Session::get('success') }}</p>
    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible">
    <p>{{ Session::get('error') }}</p>
    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif