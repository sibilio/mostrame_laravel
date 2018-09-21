<?php
namespace App\BaseApp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BaseApp\BaseRepository;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
   /**
    * @var type BaseRepository
    */
   protected $repository;
   
   /**
    * Caminho para se chegar a view, deve ser colocado no formato que o comando view()
    * interprete, ou seja, se os arquivos estiverem na pasta resources/views/back/clientes/
    * o valor de viewPath deverá ser 'back.clientes'
    * @var type string
    */
   protected $viewPath;
   
   /**
    * Array contendo as regras de validação como utilizado na função
    * $this->validate($request,<code>[Array]</code>)
    * @var type Array
    */
   protected $validateRoles;
   
   /**
    * É o prefixo da rota criado no arquivo de rotas (normalmente routes/web.php)
    * @var type string
    */
   protected $routeNamePrefix;
   
   /**
    * Model que será usado para instanciar o BaseRepository
    * @var type Model
    */
   protected $model;
   
   /**
    * Mensagem que irá aparecer em caso de registro editado com sucesso
    * @var type string
    */
   protected $editMessage;
   
   /**
    * Mensagem que irá aparecer em caso de registro adicionado com sucesso
    * @var type string
    */
   protected $addMessage;
   
   /**
    * Nome do campo que será pesquisado na tabela através do campo pesquisar
    * da view
    * @var type string
    */
   protected $fieldSearch;
   
   /**
    * Array com as permissões de crud para esse controller no seguinte formato:<br>
    * <b>Exemplo:</b><br>
    * protected $crud = [<br>
    * 'c'=>'create.cliente', //permite criar novo cliente<br>
    * 'r'=>'read.cliente', //permite ler/recuperar o cliente<br>
    * 'u'=>'update.cliente', //permite editar dados do cliente<br>
    * 'd'=>'delete.cliente', //permite excluir um cliente<br>
    * ];
    * @var type Array
    */
   protected $crud;

   public function __construct()
   {
      $this->repository = new BaseRepository($this->model);
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user()->cantDoIt($this->crud['r'])){
          return view('templates.sem-permissao');
       }
       
       $repository = $this->repository->getAll(10);
       return view($this->viewPath.'.listagem')->with('registros', $repository);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->cantDoIt($this->crud['c'])){
          return view('templates.sem-permissao');
       }
       
       return view($this->viewPath.'.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->cantDoIt($this->crud['c'])){
          return view('templates.sem-permissao');
        }
        
        $this->validate($request, $this->validateRoles);
        $this->repository->create($request->all());

        return view('templates.mensagem')
                  ->with('mensagem', $this->addMessage)
                  ->with('nome_rota', $this->routeNamePrefix.'.index')
                  ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(Auth::user()->cantDoIt($this->crud['u'])){
          return view('templates.sem-permissao');
      }
      
      $permissao = $this->repository->get($id);
      return view($this->viewPath.'.editar')->with('registro', $permissao);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->cantDoIt($this->crud['u'])){
          return view('templates.sem-permissao');
        }
        
        $this->validate($request, $this->validateRoles);
        $permissao = $this->repository->get($id);
        $permissao->fill($request->all());
        $permissao->save();
        
        return view('templates.mensagem')
                  ->with('mensagem', $this->editMessage)
                  ->with('nome_rota', $this->routeNamePrefix.'.index')
                  ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(Auth::user()->cantDoIt($this->crud['d'])){
          return view('templates.sem-permissao');
       }
       
       $this->repository->delete($id);
       
       return redirect()->route($this->routeNamePrefix.'.index');
    }
    
    public function search(Request $request)
    {
       if(Auth::user()->cantDoIt($this->crud['r'])){
          return view('templates.sem-permissao');
       }
       
       if(!isset($request['parametro'])){
          redirect ()->route($this->routeNamePrefix.'.index');
       }
       
       $registros = $this->repository->search($this->fieldSearch, $request['parametro'], 10);
       
       return view($this->viewPath.'.listagem')->with('registros', $registros);
    }
}