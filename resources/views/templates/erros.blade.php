@if (count($errors) > 0)
<div class='alert alert-danger' style='margin-left:20px;  margin-right:30px;'>
   <ul>
     @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
     @endforeach
   </ul>
</div>
@endif