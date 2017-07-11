<?php
namespace App\Controller;

/**
 * CakePHP EstadosController
 * 
 * @author Walison
 */
class EstadosController extends AppController {
	public function ajaxPesquisarEstados(){
		$this->viewBuilder()->autoLayout(false);

		$this->response->type('json');
		
		$conditions = [];
		$retorno = [];

		if( $this->request->getData('estado') != '' )
			$conditions['nome LIKE '] = '%' . $this->request->getData('estado') . '%';

		$paises = $this->Estados->find('all', ['conditions' => $conditions]);

		$i = 0;
		foreach($paises as $pais){
			$retorno[$i]['id'] = $pais['id'];
			$retorno[$i]['label'] = $pais['nome'];
			
			$i++;
		}

		$this->set('_serialize', json_encode($retorno));
	}
}
