<?php 

namespace App\Controller;

use App\Helper\SessionInitHelper;
use Sys\Request\Request;
use App\Security\Csrf;
use App\Model\HomeModel;
use App\Helper\View;

class HomeController 
{
	use \App\Machinery\TraitMachinery;

	private $homeModel = null;
	private $loadView  = null;
	private $data      = [];

	public function __construct() 
	{
		SessionInitHelper::run();
		$this->homeModel  = new HomeModel();
	}

	public function index(string $msg="") : void
	{
		$this->data['resultSet'] = $this->homeModel->all(); //(new HomeModel())->all();
		$this->data['title']     = "Home - MZ Framework 1.0";
		$this->data['csrf']      = Csrf::get();
		$this->data['msg'] = $msg;
		

		// $this->traitLoadView('template/header', $this->data);
		// $this->traitLoadView('content/index'  , $this->data);
		// $this->traitLoadView('template/footer',[]);

		View::render('template/header', $this->data);
		View::render('content/index'  , $this->data);
		View::render('template/footer',[]);

	}

	public function add() : void 
	{
		$this->data['title'] = "Adicionar - MZ Framework 1.0";

	}

	public function insert()
	{
		// cross site request forged
		if (!Csrf::run($_REQUEST['csrf'])) {
			throw new \Exception('Error. Token missed');
		}
		
		// recebendo a requisição e encriptando a senha
		$request = Request::run();
		$request['pass'] = sha1($request['pass']);

		// inserindo no banco de dados
		$this->homeModel->insert($request);

		// retornando para index
		$this->index("Inserido com Sucesso");

	}
}