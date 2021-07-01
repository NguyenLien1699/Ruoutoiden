@php
    $type = '';
    $message = '';
    if(isset($_GET['type'])) {
        switch($_GET['type']) {
            case 'success': {
                $type = 'success';
                break;
            }
            case 'error': {
                $type = 'danger';
                break;
            }
            default: {
                $type = '';
                break;
            }
        }
    }
    if(isset($_GET['message'])) {
        $message = $_GET['message'];
    }
@endphp
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