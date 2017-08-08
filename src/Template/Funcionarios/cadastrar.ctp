<?php echo $this->Form->create($funcionario, ['novalidate' => true]); ?>
<div>
	<?php
	echo $this->Form->button('Salvar', ['class' => 'btn btn-primary']);
	echo $this->Html->link('Novo', ['action' => 'cadastrar'], ['class' => 'btn btn-success']);
	echo $this->Html->link('Apagar', '#', ['class' => 'btn btn-danger']);
	echo $this->Html->link('Abrir', ['action' => 'index'], ['class' => 'btn btn-info']);
	?>
</div>
<ul class="nav nav-tabs nav-justified">
	<li class="active"><a href="#dados-basicos" data-toggle="tab">Dados Básicos</a></li>
	<li><a href="#endereco" data-toggle="tab">Endereço</a></li>
	<li><a href="#foto" data-toggle="tab">Foto</a></li>
	<li><a href="#formacao" data-toggle="tab">Formação</a></li>
	<li><a href="#breve-descricao" data-toggle="tab">Breve Descrição</a></li>
	<li><a href="#anexos" data-toggle="tab">Anexos</a></li>
	<li><a href="#dependentes" data-toggle="tab">Dependentes</a></li>
</ul>
<?php echo $this->Form->hidden('uuid', ['value' => $uuid]); ?>
<div class="tab-content">
	<div id="dados-basicos" class="tab-pane fade in active">
		<?php echo $this->element('Funcionarios/dados_basicos'); ?>
	</div>
	<div id="endereco" class="tab-pane fade">
		<?php echo $this->element('Funcionarios/endereco'); ?>
	</div>
	<div id="foto" class="tab-pane fade">
		<?php echo $this->element('Funcionarios/foto'); ?>
	</div>
	<div id="formacao" class="tab-pane fade">
		<?php echo $this->element('Funcionarios/formacao'); ?>
	</div>
	<div id="breve-descricao" class="tab-pane fade">
		<?php echo $this->element('Funcionarios/breve_descricao'); ?>
	</div>
	<div id="anexos" class="tab-pane fade">
		<?php echo $this->element('Funcionarios/anexos'); ?>
	</div>
	<div id="dependentes" class="tab-pane fade">
		<?php echo $this->element('Funcionarios/dependentes'); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
