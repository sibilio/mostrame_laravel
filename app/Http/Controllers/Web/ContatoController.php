<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContatoEmail;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function index()
    {
        return view('Web.entre_em_contato');
    }
    
    /**
     * Envia um email com os dados do formulário para o email do móstrame
     * @param Request $request
     */
    public function enviarFormulario(Request $request)
    {
        $parametros = $request->all();
        
        Mail::to($request->email)->send(new ContatoEmail($parametros));
        
        return view("Web.entre_em_contato")->with('confirmacao', true);
    }
}
