<?php

namespace App\Controller;

/**
 * CakePHP FuncionariosController
 * 
 * @author Walison
 */
class FuncionariosController extends AppController {

	/**
	 * 
	 * 
	 * 
	 */
	public function index() {
		$this->set('funcionarios', $this->Funcionarios->find('all'));
//		$this->request->session()->destroy();
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function cadastrar() {
		$funcionario = $this->Funcionarios->newEntity();

		if ($this->request->is('post')) {
			$this->Funcionarios->patchEntities($funcionario, $this->request->getData());
			if ($this->Funcionarios->save($funcionario)) {
				$this->Flash->success('O país foi salvo com sucesso!');
				$this->request->session()->delete('funcionario.' . $this->request->getData['uuid']);
				$this->redirect('/index');
			} else
				$this->Flash->error('Houve um erro ao tentar salvar o país.');
		}

		$uuid = uniqid("uuidf");
//		$this->request->session()->destroy();
//		$this->request->session()->write('funcionario.' . $uuid, []);
		
		// Relacionamentos com funcionário
		$cursos = $this->Funcionarios->FuncionariosCursos->Cursos->find('list');
		$cursosFuncionario = [];
		$memorandos = [];
		$oficios = [];
		$dependentes = [];

		$this->set('funcionario', $funcionario);
		$this->set('uuid', $uuid);
		$this->set('cursos', $cursos);
		$this->set('memorandos', $memorandos);
		$this->set('oficios', $oficios);
		$this->set('cursosFuncionario', $cursosFuncionario);
		$this->set('dependentes', $dependentes);
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function editar() {
		$funcionario = $this->Funcionarios->get($this->request->getData('id'));

		if ($this->request->is('post') && $this->request->getData('btn-salvar') == 'salvar') {
			$this->Funcionarios->patchEntities($funcionario, $this->request->getData());
			if ($this->Funcionarios->save($funcionario))
				$this->Flash->success('O país foi salvo com sucesso!');
			else
				$this->Flash->error('Houve um erro ao tentar salvar o país.');
		}

//		$cursos = $this->Funcionarios->FuncionariosCursos->Cursos->find('list');

		$this->set('funcionario', $funcionario);
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function visualizar() {
		$funcionario = $this->Funcionarios->get($this->request->getData('id'));

		$this->set('funcionario', $funcionario);
	}

	/**
	 * 
	 * 
	 * @param type $md5Veiculo
	 * @return type
	 * @throws BadRequestException
	 */
	public function ajaxUploadImagem() {
		$this->viewBuilder()->autoLayout(false);

		$this->response->type('json');

		$resposta = [];

		if ($this->request->is('post')) {
			try {
				$resposta = $this->extrairInformacoesArquivo($this->request->getData('foto'), ['image/jpeg', 'image/png']);

				$this->request->session()->write($this->request->getData('uuid') . '.foto', $resposta['bytes']);
			} catch (\Exception $ex) {
				$this->response = $this->response->withStatus($ex->getCode());
				$resposta = ['erro' => ['mensagem' => $ex->getMessage()]];
			}
		}

		$resposta['bytes'] = base64_encode($resposta['bytes']);
		
		$this->set('resposta', $resposta);
	}


	/**
	 * 
	 * 
	 * @param type $md5Veiculo
	 * @return type
	 * @throws BadRequestException
	 */
	public function ajaxUploadAnexos() {
		$this->viewBuilder()->autoLayout(false);

		$this->response->type('json');

		if ($this->request->is('post')) {
			try {
				$formatosAceitos = [
					'application/pdf',
					'application/msword',
					'application/vnd.ms-word',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
					'application/vnd.ms-excel',
					'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
					'image/jpeg',
					'image/png'
				];
				$resposta = $this->extrairInformacoesArquivo($this->request->getData('foto'), $formatosAceitos);
				$resposta['anexotipo'] = $this->request->getData('anexotipo');
				
				$anexos = $this->request->session()->read($this->request->getData('uuid') . '.anexos');
				
				// Gerando uuid para identificação do anexo.
				$uuid = uniqid("uuida");
				
				// Outras informações dos dependentes
				$resposta['uuida']	= $uuid;
				
				$anexos[$uuid] = $resposta;
				
				$this->request->session()->write($this->request->getData('uuid') . '.anexos', $anexos);
			} catch (Exception $ex) {
				$this->response = $this->response->withStatus($ex->getCode());
				$resposta = ['erro' => ['mensagem' => $ex->getMessage()]];
			}
		}

		$resposta['bytes'] = base64_encode($resposta['bytes']);

		$this->set('resposta', $resposta);
	}

	/**
	 * 
	 * 
	 * @param type $md5Veiculo
	 * @return type
	 * @throws BadRequestException
	 */
	public function ajaxUploadDependentes() {
		$this->viewBuilder()->autoLayout(false);

		$this->response->type('json');

		if ($this->request->is('post')) {
			try {
				// Verificando se é uma edição ou se é um novo dependente
				if( ( !empty($this->request->getData('id')) && !empty($this->request->getData('foto.tmp_name')) ) || empty($this->request->getData('id')) ) {
					// Extraindo as informações do arquivo do dependente
					$resposta = $this->extrairInformacoesArquivo($this->request->getData('foto'), ['image/jpeg', 'image/png']);
				}

				// Pegando toda a sessão que contém o array de dependentes
				$dependentes = $this->request->session()->read($this->request->getData('uuid') . '.dependentes');

				// Gerando uuid para identificação do dependente.
				$uuid = uniqid("uuidd");

				// Verificando se id foi preenchido
				if( !empty($this->request->getData('id')) )
				{
					$uuid = $this->request->getData('id'); // Sobrescrevendo o uuid com pelo que veio via post
					// Se nenhuma arquivo foi enviada, considerar o arquivo da sessão.
					if( empty($this->request->getData('foto.tmp_name')) )
						$resposta = $dependentes[$uuid];
				}
				
				// Outras informações dos dependentes
				$resposta['uuidd']	= $uuid;
				$resposta['nome']	= $this->request->getData('nome');

				// Incrementando o array de dependentes
				$dependentes[$uuid] = $resposta;

				// Sobrescrevendo o array de dependentes
				$this->request->session()->write($this->request->getData('uuid') . '.dependentes', $dependentes);
			} catch (Exception $ex) {
				$this->response = $this->response->withStatus($ex->getCode());
				$resposta = ['erro' => ['mensagem' => $ex->getMessage()]];
			}
		}

		$resposta['bytes'] = base64_encode($resposta['bytes']);

		$this->set('resposta', $resposta);
	}

	
	public function ajaxApagarAnexos() {
		if( !$this->request->session()->check($this->request->getData('uuid') . '.anexos.' . $this->request->getData('id')) )
			throw new \Exception('O anexo selecionado não existe.');

		$this->request->session()->delete($this->request->getData('uuid') . '.anexos.' . $this->request->getData('id'));
	}

	
	public function ajaxApagarDependentes() {
		if( !$this->request->session()->check($this->request->getData('uuid') . '.dependentes.' . $this->request->getData('id')) )
			throw new \Exception('O dependente selecionado não existe.');

		$this->request->session()->delete($this->request->getData('uuid') . '.dependentes.' . $this->request->getData('id'));
	}
}
