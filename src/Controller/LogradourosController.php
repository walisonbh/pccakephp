<?php
namespace App\Controller;

/**
 * CakePHP LogradourosController
 * 
 * @author Walison
 */
class LogradourosController extends AppController {
	public function initialize() {
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	public function ajaxPesquisarLogradouroPorCep(){
		$this->viewBuilder()->autoLayout(false);

		$this->response->type('json');
		
		$conditions = [];
		$retorno = [];
		
		if( $this->request->getData('cep') != '' )
			$conditions['cep'] = $this->request->getData('cep');
		if( $this->request->getData('logradouros') != '' )
			$conditions['logradouros'] = $this->request->getData('logradouros');

		$logradouros = $this->Logradouros->find('all', ['conditions' => $conditions])->contain([
			'Bairros' => [
				'Cidades' => [
					'Estados'
				]
			]
		])->first();

		$retorno['id'] = $logradouros['id'];
		$retorno['cep'] = $logradouros['cep'];
		$retorno['logradouro'] = $logradouros['nome'];
		$retorno['bairro'] = $logradouros['bairro']['nome'];
		$retorno['cidade'] = $logradouros['bairro']['cidade']['nome'];
		$retorno['estado'] = $logradouros['bairro']['cidade']['estado']['nome'];

		$this->set('_serialize', json_encode($retorno));
	}
}
