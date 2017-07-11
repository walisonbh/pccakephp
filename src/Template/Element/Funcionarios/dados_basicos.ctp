<script>
$(function(){
//	$('#span-pesquisar-pais').on('click', function(){
//		$('<input type="hidden" name="" />').insertBefore($(this).parent().parent());
//		$('<div class="list-group"><a href="#" class="list-group-item" data-id="" data-label="">Teste</a></div>').insertAfter($(this).parent().parent());
//	});
	$('#pais').bootcomplete({
		url:'<?php echo $this->Url->build('/paises/ajax-pesquisar-paises/') ?>',
		method: 'post',
		minLength: 3,
		idFieldName: 'pais_id',
		formParams: { pais : $('#pais') }
	});

	$('#estado').bootcomplete({
		url:'<?php echo $this->Url->build('/estados/ajax-pesquisar-estados/') ?>',
		method: 'post',
		minLength: 3,
		idFieldName: 'estado_id',
		formParams: {pais_id: $('#hidden-field-pais_id'), estado : $('#estado')}
	});

	$('#cidade').bootcomplete({
		url:'<?php echo $this->Url->build('/cidades/ajax-pesquisar-cidades/') ?>',
		method: 'post',
		minLength: 3,
		idFieldName: 'cidade_id',
		formParams: {estado_id: $('#hidden-field-estado_id'), cidade : $('#cidade')}
	});
});
</script>

<h2>Dados Básicos</h2>
<?php
echo $this->Form->control('nome');
echo $this->Form->control('cpf', ['label' => 'CPF']);
echo $this->Form->control('matricula', ['label' => 'Matrícula']);
echo $this->Form->control('salario', ['label' => 'Salário']);
echo $this->Form->control('pais_', ['label' => 'País', 'id' => 'pais', 'append' => '<span class="glyphicon glyphicon-search" id="span-pesquisar-pais" aria-hidden="true"></span>']);
echo $this->Form->control('estado_', ['id' => 'estado', 'append' => '<span class="glyphicon glyphicon-search" id="span-pesquisar-estado" aria-hidden="true"></span>']);
echo $this->Form->control('cidade_', ['id' => 'cidade', 'append' => '<span class="glyphicon glyphicon-search" id="span-pesquisar-cidade" aria-hidden="true"></span>']);
echo $this->Form->control('estadocivil', ['label' => 'Estado Civil']);
echo $this->Form->control('temfilhos', ['type' => 'checkbox', 'label' => 'Tem Filhos']);
