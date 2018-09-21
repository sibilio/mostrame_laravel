<td>
   @if ($registro->bloqueado)
      <i id="{{'cadeado_'.$registro->id}}"class="fa fa-lock" style='display:inline' aria-hidden="true"></i> {{$registro->id}}
   @else
      <i id="{{'cadeado_'.$registro->id}}"class="fa fa-lock" style='display:none' aria-hidden="true"></i> {{$registro->id}}
   @endif
</td>
<td>{{$registro->name}}</td>
<td>{{$registro->email}}</td>
<td>{{$registro->papel->descricao}}</td>
<td class='text-center'>
   <a href="{{route($routePrefix.'.edit',['permisoe'=>$registro->id])}}" class="btn btn-success">
       <span class="glyphicon glyphicon-pencil" aria-hidden="false"></span>
   </a>
   <a href="#" class="btn btn-danger botaoExcluir" aria-label="Left Align" data-target="#confirmaExclusao"
      title="Excluir categoria" data-toggle="modal" data-placement="bottom" tooltip
      data-idExcluir="{{$registro->id}}">
           <span class="glyphicon glyphicon-trash" aria-hidden="false"></span>
   </a>
   @if($registro->bloqueado)
      <a href="#" class="btn btn-primary botao-bloquear" data-user-id='{{$registro->id}}'>
         <i class="fa fa-unlock-alt" aria-hidden="true"></i>
      </a>
   @else
      <a href="#" class="btn btn-info botao-bloquear" data-user-id='{{$registro->id}}'>
         <i class="fa fa-lock" aria-hidden="true"></i>
      </a>
   @endif
</td>