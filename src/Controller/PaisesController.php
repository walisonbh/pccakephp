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
	/**
	 * 
	 * 
	 * 
	 */
	public function initialize() {
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function index() {
		$conditions = [];

		if( $this->request->is('post') )
			$conditions = $this->request->getData();
		
		$this->set('paises', $this->paginate('Paises', ['conditions' => $conditions]));
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function cadastrar() {
		$pais = $this->Paises->newEntity();

		if( $this->request->is('post') ) {
			$this->Paises->patchEntity($pais, $this->request->getData(), [
					'associated' => [
						'Estados',
						'Estados.Cidades'
					]
				]
			);
			if( $this->Paises->save($pais, [
					'associated' => [
						'Estados',
						'Estados.Cidades'
					]
				]) ) {
				$this->Flash->success('O país foi salvo com sucesso!');
				$this->redirect('/paises');
			}
			else
				$this->Flash->error('Houve um erro ao tentar salvar o país.');
		}
		
		$this->set('pais', $pais);
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function editar() {
		$pais = $this->Paises->get($this->request->getData('id'), [
			'contain' => [
				'Estados',
				'Estados.Cidades'
			]
		]);

		if( $this->request->getData('btn-salvar') == 'salvar' ) {
			$this->Paises->patchEntity($pais, $this->request->getData(), [
					'associated' => [
						'Estados',
						'Estados.Cidades'
					]
				]
			);
			if( $this->Paises->save($pais, [
				'associated' => [
					'Estados',
					'Estados.Cidades'
				]
			]) ){
				$this->Flash->success('O país foi salvo com sucesso!');
//				$this->redirect('/paises');
			}
			else
				$this->Flash->error('Houve um erro ao tentar salvar o país.');
		}
		
		$this->set('pais', $pais);
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function visualizar() {
		$pais = $this->Paises->get($this->request->getData('id'));
		
		$this->set('pais', $pais);
	}
	
	/**
	 * 
	 * 
	 * 
	 */
	public function excluir(){
		$pais = $this->Paises->get($this->request->getData('id'));

//		$pais = $this->Paises->get($this->request->getData('id'), [
//			'contain' => [
//				'Estados',
//				'Estados.Cidades'
//			]
//		]);
		
		if( $this->Paises->delete($pais) )
			$this->Flash->success('O país foi apagado com sucesso!');
		else
			$this->Flash->error('Houve um erro ao tentar apagar o país.');
		
//		$this->redirect(['action' => 'index']);
	}

	/**
	 * 
	 * 
	 * 
	 */
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
