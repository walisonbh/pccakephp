<?php

namespace App\Controller;

/**
 * CakePHP CidadesController
 * 
 * @author Walison
 */
class CidadesController extends AppController {
	public function ajaxPesquisarCidades(){
		$this->viewBuilder()->autoLayout(false);

		$this->response->type('json');
		
		$conditions = [];
		$retorno = [];

		if( $this->request->getData('cidade') != '' )
			$conditions['nome LIKE '] = '%' . $this->request->getData('cidade') . '%';

		$paises = $this->Cidades->find('all', ['conditions' => $conditions]);

		$i = 0;
		foreach($paises as $pais){
			$retorno[$i]['id'] = $pais['id'];
			$retorno[$i]['label'] = $pais['nome'];
			
			$i++;
		}

		$this->set('_serialize', json_encode($retorno));
	}
}
