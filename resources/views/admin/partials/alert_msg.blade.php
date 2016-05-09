@if(Session::has('message') && Session::has('level'))
    <div class="col-md-12">
        <div class="alert alert-{{ Session::get('level') }}">{!! Session::get('message') !!}</div>
    </div>
@endif