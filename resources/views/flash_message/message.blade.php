@if($message = Session::get('success'))
    <div class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> {{ $message }}.
    </div>
@endif()

@if($message = Session::get('warning'))
    <div class="alert alert-warning fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Warning!</strong> {{ $message }}.
    </div>
@endif()

@if($message = Session::get('error'))
    <div class="alert alert-error fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> {{ $message }}.
    </div>
@endif()

{{--Validation error--}}
@if ($errors->any())
    <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif



