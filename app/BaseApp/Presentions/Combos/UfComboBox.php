<?php
namespace App\BaseApp\Presentions\Combo;

class UfComboBox
{
   public static function doIt($oldValue = null)
   {
      $html  = "<div class='selectContainer elemento-responsivo'>";
      $html .= "<select class='form-control' id='uf' name='uf'  style='width=100%;'>";
      $html .= "<option value=\"\">Selecione</option>";
      $html .= "<option value=\"AC\" ".(($oldValue=='AC')?'selected':'').">Acre</option>";
      $html .= "<option value=\"AL\" ".(($oldValue=='AL')?'selected':'').">Alagoas</option>";
      $html .= "<option value=\"AM\" ".(($oldValue=='AM')?'selected':'').">Amazonas</option>";
      $html .= "<option value=\"AP\" ".(($oldValue=='AP')?'selected':'').">Amapá</option>";
      $html .= "<option value=\"BA\" ".(($oldValue=='BA')?'selected':'').">Bahia</option>";
      $html .= "<option value=\"CE\" ".(($oldValue=='CE')?'selected':'').">Ceará</option>";
      $html .= "<option value=\"DF\" ".(($oldValue=='DF')?'selected':'').">Distrito Federal</option>";
      $html .= "<option value=\"ES\" ".(($oldValue=='ES')?'selected':'').">Espírito Santo</option>";
      $html .= "<option value=\"GO\" ".(($oldValue=='GO')?'selected':'').">Goias</option>";
      $html .= "<option value=\"MA\" ".(($oldValue=='MA')?'selected':'').">Maranhãp</option>";
      $html .= "<option value=\"MG\" ".(($oldValue=='MG')?'selected':'').">Minas Gerais</option>";
      $html .= "<option value=\"MS\" ".(($oldValue=='MS')?'selected':'').">Mato Grosso do Sul</option>";
      $html .= "<option value=\"MT\" ".(($oldValue=='MT')?'selected':'').">Mato Grosso</option>";
      $html .= "<option value=\"PA\" ".(($oldValue=='PA')?'selected':'').">Pará</option>";
      $html .= "<option value=\"PB\" ".(($oldValue=='PB')?'selected':'').">Paraíba</option>";
      $html .= "<option value=\"PE\" ".(($oldValue=='PE')?'selected':'').">Pernambuco</option>";
      $html .= "<option value=\"PI\" ".(($oldValue=='PI')?'selected':'').">Piauí</option>";
      $html .= "<option value=\"PR\" ".(($oldValue=='PR')?'selected':'').">Paraná</option>";
      $html .= "<option value=\"RJ\" ".(($oldValue=='RJ')?'selected':'').">Rio de Janeiro</option>";
      $html .= "<option value=\"RN\" ".(($oldValue=='RN')?'selected':'').">Rio Grande do Norte</option>";
      $html .= "<option value=\"RS\" ".(($oldValue=='RS')?'selected':'').">Rio Grande do Sul</option>";
      $html .= "<option value=\"RO\" ".(($oldValue=='RO')?'selected':'').">Roraima</option>";
      $html .= "<option value=\"RR\" ".(($oldValue=='RR')?'selected':'').">Roraina</option>";
      $html .= "<option value=\"SC\" ".(($oldValue=='SC')?'selected':'').">Santa Catarian</option>";
      $html .= "<option value=\"SE\" ".(($oldValue=='SE')?'selected':'').">Sergipe</option>";
      $html .= "<option value=\"SP\" ".(($oldValue=='SP')?'selected':'').">São Paulo</option>";
      $html .= "<option value=\"TO\" ".(($oldValue=='TO')?'selected':'').">Tocantins</option>";
      $html .= "</select>";
      $html .= "</div>";

      echo $html;
   }
}