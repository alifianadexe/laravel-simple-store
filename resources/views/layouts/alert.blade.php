@if(session('msg'))
<div class="alert alert-success">
    {{session('msg')}}
</div>
@elseif($errors->any())
<div class="alert alert-danger">
    <ul style="margin: 0; padding: 0; list-style: none">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
