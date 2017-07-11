<?php
namespace App\Controller;

/**
 * CakePHP PaisesController
 * 
 * @author Walison
 * 
 * @property PaisesTable $Paises Description
 */
class PaisesController extends AppController {
	public function initialize() {
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	public function index() {
		$this->set('paises', $this->paginate('Paises'));
	}

	public function cadastrar() {
		$pais = $this->Paises->newEntity();
		
		if( $this->request->is('post') ) {
			$this->Paises->patchEntities($pais, $this->request->getData());
			if( $this->Paises->save($pais) )
				$this->Flash->success('O país foi salvo com sucesso!');
			else
				$this->Flash->error('Houve um erro ao tentar salvar o país.');
		}
		
		$this->set('pais', $pais);
	}

	public function editar() {
		$pais = $this->Paises->get($this->request->getData('id'));
		
		if( $this->request->is('post') && $this->request->getData('btn-salvar') == 'salvar' ) {
			$this->Paises->patchEntities($pais, $this->request->getData());
			if( $this->Paises->save($pais) )
				$this->Flash->success('O país foi salvo com sucesso!');
			else
				$this->Flash->error('Houve um erro ao tentar salvar o país.');
		}
		
		$this->set('pais', $pais);
	}

	public function visualizar() {
		$pais = $this->Paises->get($this->request->getData('id'));
		
		$this->set('pais', $pais);
	}

	public function ajaxPesquisarPaises(){
		$this->viewBuilder()->autoLayout(false);

		$this->response->type('json');
		
		$conditions = [];
		$retorno = [];

		if( $this->request->getData('pais') != '' )
			$conditions = ['nome LIKE \'%' . $this->request->getData('pais') . '%\''];

		$paises = $this->Paises->find('all', ['conditions' => $conditions]);

		$i = 0;
		foreach($paises as $pais){
			$retorno[$i]['id'] = $pais['id'];
			$retorno[$i]['label'] = $pais['nome'];
			
			$i++;
		}

		$this->set('_serialize', json_encode($retorno));
	}
}
