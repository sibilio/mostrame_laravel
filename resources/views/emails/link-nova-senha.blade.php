<div>
   <p><strong>{{env('SITE_NAME')}}</strong></p>
   <p>Você solicitou uma nova senha ao nosso sistema.</p>
   <p>
      Esse link é válido por 24 horas.<br>
      Após esse período será necessário solicitar outro.<br>
      <strong>Clique no link abaixo para continuar.</strong><br>
      Se o link não abrir, copie-o e cole-o no seu navegador.
   </p>
   <br>
   <br>
   <p><a href='{{$link}}'>{{$link}}</a></p>
   <br><br>
   <p>
      Caso o pedido não foi feito por você, verifique com um de seus funcionários.<br>
      É importante saber se o pedido partiu de sua empresa.
   </p>
</div>