@if(!empty($type) && !empty($message))
<div class="row">
    <div class="col-md-12">
        <div class="sufee-alert alert with-close alert-{!! $type !!} alert-dismissible fade show">
            {!! $message !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>
        </div>
    </div>
</div>
@endif