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
		$this->loadModel('Paises');

		$funcionarios = $this->Funcionarios->find('all')->contain(['Anexos', 'Dependentes','FuncionariosCursos','FuncionariosLogradouros']);

//		$this->request->session()->destroy();

		$this->set('funcionarios', $funcionarios);
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function cadastrar() {
		$funcionario = $this->Funcionarios->newEntity();

		if ($this->request->is('post')) {
			$session = (count($this->request->session()->read($this->request->getData('uuid'))) > 0) ? $this->request->session()->read($this->request->getData('uuid')) : [];

			$dadosSalvar = array_merge($this->request->getData(), $session);

			$funcionario = $this->Funcionarios->patchEntity($funcionario, $dadosSalvar, [
					'associated' => [
						'Anexos', 
						'Dependentes',
						'FuncionariosLogradouros',
						'FuncionariosCursos',
					]
				]
			);

			if ( $this->Funcionarios->save($funcionario, [
					'associated' => [
						'Anexos', 
						'Dependentes',
						'FuncionariosLogradouros',
						'FuncionariosCursos',
					]
				]) ) {
				$this->Flash->success('O funcionário foi salvo com sucesso!');
				$this->request->session()->delete('funcionario.' . $this->request->getData['uuid']);
				$this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('Houve um erro ao tentar salvar os dados do funcionário.');
			}
		}

		$uuid = uniqid("uuidf");

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
		$funcionario = $this->Funcionarios->get($this->request->getData('id'), [
			'contain' => [
				'Anexos',
				'Dependentes',
				'FuncionariosLogradouros' => [
					'Logradouros'
				],
				'FuncionariosCursos' => [
					'Cursos'
				],
				'Cidades' => [
					'Estados' => [
						'Paises'
					]
				]
			]
		]);

		if ( $this->request->getData('btn-salvar') == 'salvar' ) {
			$session = (count($this->request->session()->read($this->request->getData('uuid'))) > 0) ? $this->request->session()->read($this->request->getData('uuid')) : [];

			$dadosSalvar = array_merge($this->request->getData(), $session);

			$this->Funcionarios->patchEntity($funcionario, $dadosSalvar, [
					'associated' => [
						'Anexos', 
						'Dependentes',
						'FuncionariosLogradouros',
						'FuncionariosCursos',
					]
				]
			);

			if ( $this->Funcionarios->save($funcionario, [
					'associated' => [
						'Anexos', 
						'Dependentes',
						'FuncionariosLogradouros',
						'FuncionariosCursos',
					]
				]) ) {
				$this->Flash->success('O funcionário foi salvo com sucesso!');
				$this->redirect(['action' => 'index']);
			}
			else
				$this->Flash->error('Houve um erro ao tentar salvar o funcionário.');
		}

		// ID único
		$uuid = uniqid("uuidf");

		// Montar sessão
		$this->montarSessao($uuid, $funcionario);

		// Relacionamentos com funcionário
		$cursos			= $this->Funcionarios->FuncionariosCursos->Cursos->find('list');
		$funcionarioCursos	= $funcionario->funcionarios_cursos;
		$anexos			= $funcionario->anexos;
		$dependentes		= $funcionario->dependentes;

		// Injetando dado no form
		$funcionario->cep	= @$funcionario->funcionarios_logradouros[0]->logradouro->cep;

		$this->set('uuid', $uuid);
		$this->set('funcionario', $funcionario);
		$this->set('cursos', $cursos);
		$this->set('anexos', $anexos);
		$this->set('funcionarioCursos', $funcionarioCursos);
		$this->set('dependentes', $dependentes);
	}

	/**
	 * 
	 * 
	 * 
	 */
	public function excluir(){
//		$funcionario = $this->Funcionarios->get($this->request->getData('id'));

		$funcionario = $this->Funcionarios->get($this->request->getData('id'), [
			'contain' => [
				'Anexos',
				'Dependentes',
				'FuncionariosLogradouros',
				'FuncionariosCursos',
			]
		]);
		
		if( $this->Funcionarios->delete($funcionario) )
			$this->Flash->success('O funcionário foi apagado com sucesso!');
		else
			$this->Flash->error('Houve um erro ao tentar apagar o funcionário.');
		
//		$this->redirect(['action' => 'index']);
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

				$this->request->session()->write($this->request->getData('uuid') . '.imagem', $resposta['bytes']);
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
			} catch (\Exception $ex) {
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
	
	public function montarSessao($uid, $funcionario){
		$this->request->session()->write($uid . '.dependentes', $funcionario->dependentes);
		$this->request->session()->write($uid . '.anexos', $funcionario->anexos);
	}
}
