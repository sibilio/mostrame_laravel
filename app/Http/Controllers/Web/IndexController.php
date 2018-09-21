<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BaseApp\BaseRepository;

class IndexController extends Controller
{
   public $cidadesRepossitory;
   
   public function __construct()
   {
      $this->cidadesRepossitory = new BaseRepository('App\Regiao');
   }
   
   public function index(){
      $regioes = $this->cidadesRepossitory->getAll();
      
      return view('Web.index')->with('regioes', $regioes);
   }
}
