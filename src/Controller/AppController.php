<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = [
		'Form' => [
			'className' => 'Bootstrap.Form',
			'useCustomFileInput' => true
		],
		'Html' => [
			'className' => 'Bootstrap.Html'
		],
		'Modal' => [
			'className' => 'Bootstrap.Modal'
		],
		'Navbar' => [
			'className' => 'Bootstrap.Navbar'
		],
		'Paginator' => [
			'className' => 'Bootstrap.Paginator'
		],
		'Panel' => [
			'className' => 'Bootstrap.Panel'
		],
		'CkEditor.Ck'
	];

	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * e.g. `$this->loadComponent('Security');`
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		$this->loadComponent('TratarImagem');

		/*
		 * Enable the following components for recommended CakePHP security settings.
		 * see http://book.cakephp.org/3.0/en/controllers/components/security.html
		 */
		//$this->loadComponent('Security');
		//$this->loadComponent('Csrf');
	}

	/**
	 * Before render callback.
	 *
	 * @param \Cake\Event\Event $event The beforeRender event.
	 * @return \Cake\Network\Response|null|void
	 */
	public function beforeRender(Event $event) {
		if (!array_key_exists('_serialize', $this->viewVars) &&
			in_array($this->response->type(), ['application/json', 'application/xml'])
		) {
			$this->set('_serialize', true);
		}
	}

/**
 * Extrai as informações do arquivo para gravar no banco de dados.
 * 
 * Possíveis Formatos
 * 
 * .jpg      image/jpeg
 * .png      image/png
 * 
 * .pdf      application/pdf
 * .doc      application/msword
 * .dot      application/msword
 * 
 * .doc      application/vnd.ms-word
 * .docx     application/vnd.openxmlformats-officedocument.wordprocessingml.document
 * .dotx     application/vnd.openxmlformats-officedocument.wordprocessingml.template
 * .docm     application/vnd.ms-word.document.macroEnabled.12
 * .dotm     application/vnd.ms-word.template.macroEnabled.12
 * 
 * .xls      application/vnd.ms-excel
 * .xlt      application/vnd.ms-excel
 * .xla      application/vnd.ms-excel
 * 
 * .xlsx     application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
 * .xltx     application/vnd.openxmlformats-officedocument.spreadsheetml.template
 * .xlsm     application/vnd.ms-excel.sheet.macroEnabled.12
 * .xltm     application/vnd.ms-excel.template.macroEnabled.12
 * .xlam     application/vnd.ms-excel.addin.macroEnabled.12
 * .xlsb     application/vnd.ms-excel.sheet.binary.macroEnabled.12
 * 
 * .ppt      application/vnd.ms-powerpoint
 * .pot      application/vnd.ms-powerpoint
 * .pps      application/vnd.ms-powerpoint
 * .ppa      application/vnd.ms-powerpoint
 * 
 * .pptx     application/vnd.openxmlformats-officedocument.presentationml.presentation
 * .potx     application/vnd.openxmlformats-officedocument.presentationml.template
 * .ppsx     application/vnd.openxmlformats-officedocument.presentationml.slideshow
 * .ppam     application/vnd.ms-powerpoint.addin.macroEnabled.12
 * .pptm     application/vnd.ms-powerpoint.presentation.macroEnabled.12
 * .potm     application/vnd.ms-powerpoint.template.macroEnabled.12
 * .ppsm     application/vnd.ms-powerpoint.slideshow.macroEnabled.12
 * 
 * @param type $arrayArquivo
 * @param type $formatosAceitos
 * @return type
 * @throws Exception
 */
	public function extrairInformacoesArquivo( $arrayArquivo, $formatosAceitos = [] ) {
		$tiposImagens = [
			'image/jpeg',
			'image/png'
		];

		$retorno = [
			'nome' => null,
			'application_type' => null,
			'formato' => null,
			'bytes' => null
		];

		if ( empty($arrayArquivo['name']) )
			throw new \Exception('Nenhuma imagem selecionada.', 401);

		if ( !in_array($arrayArquivo['type'], $formatosAceitos) )
			throw new \Exception('Formato inválido do arquivo enviado. Formatos válidos JPG e PNG.', 401);
		
		if( count($arrayArquivo) > 1 ) {
				$dadosNomeArquivo = explode('.', $arrayArquivo['name']);

				$retorno['nome'] = current($dadosNomeArquivo);
				if( in_array($arrayArquivo['type'], $tiposImagens) )
					$retorno['bytes'] = $this->TratarImagem->redimencionarImagem(file_get_contents($arrayArquivo['tmp_name']), 640, 480);
				else
					$retorno['bytes'] = file_get_contents($arrayArquivo['tmp_name']);
				$retorno['application_type'] = $arrayArquivo['type'];
				$retorno['formato'] = end($dadosNomeArquivo);			
		}
		
		return $retorno;
	}
}
