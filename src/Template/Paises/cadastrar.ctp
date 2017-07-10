<h1>País</h1>
<div>
	<?php
	echo $this->Html->link('Salvar', '#', ['class' => 'btn btn-primary']);
	echo $this->Html->link('Novo', '#', ['class' => 'btn btn-success']);
	echo $this->Html->link('Apagar', '#', ['class' => 'btn btn-danger']);
	echo $this->Html->link('Abrir', '#', ['class' => 'btn btn-info']);
	?>
</div>
<?php echo $this->Form->create($pais, ['id' => 'form-salvar-pais']); ?>
<?php echo $this->Form->control('nome', ['placeholder' => 'Nome do País']); ?>
<div class="row">
	<div class="col-lg-6">
		<?php echo $this->Html->link('Adicionar Estado', '#', ['class' => 'btn btn-success btn-xs']); ?>
	</div>
	<div class="col-lg-6"></div>
</div>
<div id="linha-mestre-estados-cidades" class="row">
	<div class="col-lg-6">
		<div class="estado"><?php echo $this->Form->control('estados.nome', ['placeholder' => 'Nome do stado', 'append' => $this->Html->link('Excluir Estado', '#')]); ?></div>
	</div>
	<div class="col-lg-6">
		<div><?php echo $this->Html->link('Adicionar Cidade', '#', ['class' => 'btn btn-success btn-xs']); ?></div>
		<div class="cidade"><?php echo $this->Form->control('cidades.nome', ['placeholder' => 'Nome da Cidade', 'append' => $this->Html->link('Excluir Cidade', '#')]); ?></div>
	</div>
</div>
<div id="linhas-estados-cidades" class="row">
	
</div>
<?php echo $this->Form->end(); ?>