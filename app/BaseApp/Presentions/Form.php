<?php
namespace App\BaseApp\Presentions;

/**
 * Classe destinada a facilitar a criação de formulário no laravel com html e bootstrap
 */
class Form{
   
   /**
    * Abre o formulário
    * @param array $parametros os valores para o array são:<br>
    * <b>id</b> = o id que será atribuido ao formulário, se não passado o id será form<br>
    * <b>method</b> = método de submit do formulário, padrão é post<br>
    * <b>action</b> = link para submeter o formulário, o padrão é #
    */
   public static function open(Array $parametros=[])
   {
      $id = $parametros['id'] ?? "form";
      $method = self::adjustMethod($parametros['method']) ?? "post";
      $verb = $parametros['method'];
      $action = $parametros['action'] ?? "#";
      
      $html = "<div class='col-md-12'>";
      $html.= "<form id='$id' method='$method' action='$action'>";
      
      if($method === 'post'){
         $html .= csrf_field();
         
         if($verb==='put' || $verb==='patch' || $verb==='delete')
            $html .= "<input name='_method' type='hidden' value='".$verb."'>";
      }
      
      echo $html;
   }
   
   /**
    * Fecha o formulário
    */
   public static function close()
   {
      echo "</form></div>";
   }
   
   /**
    * Cria um input type text
    * @param array $parametros os parâmetros possíveis são:<br>
    * <b>col</b> = valor da colula no formato do bootstrap. Ex: col-md-5<br>
    * <b>label</b> = Valor do label para o campo<br>
    * <b>id</b> = id do campo<br>
    * <b>row</b> = Se true o input será colocado sozinho em uma linha<br>
    * <b>name</b> = propriedade name do input text<br>
    * <b>placeholder</b> = placeholder do input text<br>
    * <b>value</b> = valor padrão do input
    */
   public static function text(Array $parametros=[])
   {
      echo self::input($parametros, 'text');
   }
   
   /**
    * Cria um input type password
    * @param array $parametros os parâmetros possíveis são:<br>
    * <b>col</b> = valor da colula no formato do bootstrap. Ex: col-md-5<br>
    * <b>label</b> = Valor do label para o campo<br>
    * <b>id</b> = id do campo<br>
    * <b>row</b> = Se true o input será colocado sozinho em uma linha<br>
    * <b>name</b> = propriedade name do input password<br>
    * <b>placeholder</b> = placeholder do input password<br>
    * <b>value</b> = valor padrão do input
    */
   public static function password(Array $parametros=[])
   {
      echo self::input($parametros, 'password');
   }
   
   /**
    * Cria um input type email
    * @param array $parametros os parâmetros possíveis são:<br>
    * <b>col</b> = valor da colula no formato do bootstrap. Ex: col-md-5<br>
    * <b>label</b> = Valor do label para o campo<br>
    * <b>id</b> = id do campo<br>
    * <b>row</b> = Se true o input será colocado sozinho em uma linha<br>
    * <b>name</b> = propriedade name do input password<br>
    * <b>placeholder</b> = placeholder do input password<br>
    * <b>value</b> = valor padrão do input
    */
   public static function email(Array $parametros=[])
   {
      echo self::input($parametros, 'email');
   }
   
   /**
    * Cria o botão submite
    * @param array $parametros os valores passados no array podem ser:<br>
    * <b>color</b> = primary, danger, info, warning ou success. O padrão é default<br>
    * <b>value</b> = valor que aparecerá como label do botão submite. O padrão é string vazia.
    */
   public static function buttonSubmite(Array $parametros=[])
   {
      $color = $parametros['color'] ?? '';
      $value = $parametros['value'] ?? '';
      echo "<input type='submit' class='".self::chosseColorButton($color)."' value='".$value."'>";
   }
   
   
   /**
    * Cria um botão que na verdade é um link
    * @param array $parametros os valores possíveis para o array são:<br>
    * <b>href</b> = rota do link<br>
    * <b>color</b> = cor do botão<br>
    * <b>label</b> = label que irá aparecer no botão.<br>O padrão é label='botão'.
    */
   public static function buttonLink(Array $parametros=[])
   {
      $href  = $parametros['href'] ?? '#';
      $color = self::chosseColorButton($parametros['color']) ?? self::chosseColorButton();
      $label = $parametros['label'] ?? 'Botão';
      $id = $parametros['id'] ?? time().'_id';
      echo "<a href='$href' class='$color' id='$id'>$label</a>";
   }
   
   /**
    * Imprimi o combo-box com os papeis cadastrados
    */
   public static function papelCombo($parametros)
   {
      echo self::combo('papel', $parametros);
   }
   
   /**
    * Cria um input type checkbox
    * @param array $parametros os parâmetros possíveis são:<br>
    * <b>col</b> = valor da colula no formato do bootstrap. Ex: col-md-5<br>
    * <b>label</b> = Valor do label para o campo<br>
    * <b>id</b> = id do campo<br>
    * <b>row</b> = Se true o input será colocado sozinho em uma linha<br>
    * <b>name</b> = propriedade name do input password<br>
    * <b>value</b> = true/false
    * <b>style</b> = valor do atributo style no html do checkbox
    */
   public static function checkBox($parametros)
   {
      $col = $parametros['col'] ?? 'col-md-12';
      $label = $parametros['label'] ?? 'label:';
      $id = $parametros['id'] ?? 'campo';
      $name = $parametros['name'] ?? $id;
      $value = $parametros['value'] ?? "";
      $style = $parametros['style'] ?? "";
      $row = $parametros['row'] ?? true;
      
      $checked = ($value==true)?'checked':'';
      
      $html = ($row)?"<div class='row'>":'';
      $html.= "<div class='checkbox'>";
      $html.= "<label style='$style'>";
      $html.= "<input id='$id' name='$name' type='checkbox' value='true' ".$checked."><strong>$label</strong>";
      $html.= "</label>";
      $html.= "</div>";
      $html.= ($row)?"</div>":'';
      
      echo $html;  
   }
   
   /**
    * Retorna a string para formatação de um botão no bootstrap
    * @param String $color valores para <var>$color</var>: <b>primary</b>, <b>danger</b>, <b>info</b>, <b>warning</b>, <b>success</b>.
    * Se não passado será preenchido como <b>default</b>.
    * @return string Retorna a string de configuação de botão do bootstrap. Ex: 'btn btn-primary'
    */
   static private function chosseColorButton(String $color='')
   {
      $classColor = '';
      switch($color){
         case 'primary':
            $classColor = 'btn btn-primary';
            break;
         case 'danger':
            $classColor = 'btn btn-danger';
            break;
         case 'info':
            $classColor = 'btn btn-info';
            break;
         case 'warning':
            $classColor = 'btn btn-warning';
            break;
         case 'success':
            $classColor = 'btn btn-success';
            break;
         default:
            $classColor = 'btn btn-default';
            break;
      }
      
      return $classColor;
   }
   
   /**
    * Método que evita a repetição de código para os diferentes tipos de input box que existem
    * @param array $parametros
    * @param type $inputType
    * @return type string
    */
   private static function input(Array $parametros, $inputType)
   {
      $col = $parametros['col'] ?? 'col-md-12';
      $label = $parametros['label'] ?? 'label:';
      $id = $parametros['id'] ?? 'campo';
      $name = $parametros['name'] ?? $id;
      $placeholder = $parametros['placeholder'] ?? $label;
      $value = $parametros['value'] ?? "";
      $row = $parametros['row'] ?? true;
      
      $html = ($row)?"<div class='row'>":'';
      $html.= "<div class='$col'>";
      $html.= "<div class='form-group'>";
      $html.= "<label for='$id'>$label:</label>";
      $html.= "<input id='$id' name='$name' type='$inputType' class='form-control' placeholder='$placeholder' value='$value'>";
      $html.= "</div>";
      $html.= "</div>";
      $html.= ($row)?"</div>":'';
      
      return $html;  
   }
   
   /**
    * Ajusta o método de submissão do formulário entre <b>post</b> e <b>get</b> ao utilizarmos
    * chamadas não permitidas como <b>PUT</b>, <b>PATCH</b> e <b>DELETE</b>.
    * @param string $method Representa o método de submissão do formulário.
    */
   private static function adjustMethod($method)
   {
      if($method == 'put' || $method == 'patch' || $method == 'delete' || $method == 'post')
         return 'post';
      else
         return 'get';
   }
   
   /**
    * Função interna para escolher o combo que será desenhado
    * @param string $comboType
    * @return type string
    */
   private static function combo(string $comboType, Array $parametros)
   {
      $combo = "";
      
      switch ($comboType) {
         case 'papel':
            $combo = Combos\PapelCombo::doIt($parametros['value']);
            break;

         default:
            return "";
      }
      
      $col = $parametros['col'] ?? 'col-md-12';
      $label = $parametros['label'] ?? 'label:';
      $row = $parametros['row'] ?? true;
      
      $html = ($row)?"<div class='row'>":'';
      $html.= "<div class='$col'>";
      $html.= "<div class='form-group'>";
      $html.= "<label for='papel-combo'>$label:</label>";
      $html.= $combo;
      $html.= "</div>";
      $html.= "</div>";
      $html.= ($row)?"</div>":'';
      
      return $html;
   }
}

