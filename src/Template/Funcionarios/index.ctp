<script>
	$(function(){
		$('#form-pesquisar-funcionario .text div.col-md-10').attr('class', 'col-md-12')
	});
</script>
<?php
echo $this->Html->tag('h1', 'Funcionários');
echo $this->Html->tag('div', $this->Html->link('Pesquisar', '#', ['class' => 'btn btn-info']) . $this->Html->link('Novo', ['action' => 'cadastrar'], ['class' => 'btn btn-success']));
echo $this->Form->create(null, ['horizontal' => true, 'id' => 'form-pesquisar-funcionario']);
?>
<div class="row">
	<div class="col-md-4"><?php echo $this->Form->control('funcionario', ['type' => 'text', 'placeholder' => 'Nome', 'label' => false]); ?></div>
	<div class="col-md-4"><?php echo $this->Form->control('cpf', ['placeholder' => 'CPF', 'label' => false]); ?></div>
	<div class="col-md-4"><?php echo $this->Form->control('matricula', ['placeholder' => 'Matrícula', 'label' => false]); ?></div>
</div>
<div class="row">
	<div class="col-md-4"><?php echo $this->Form->control('pais', ['placeholder' => 'País', 'label' => false, 'append' => '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>']); ?></div>
	<div class="col-md-4"><?php echo $this->Form->control('estado', ['placeholder' => 'Estado', 'label' => false, 'append' => '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>']); ?></div>
	<div class="col-md-4"><?php echo $this->Form->control('cidade', ['placeholder' => 'Cidade', 'label' => false, 'append' => '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>']); ?></div>
</div>
<?php
echo $this->Form->end();
?>
<table class="table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>CPF</th>
			<th>Matrícula</th>
			<th>Salário</th>
			<th>Foto</th>
			<th>Cursos</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if( count($funcionarios) > 0 ){
			foreach ( $funcionarios as $indice => $funcionario ) {
		?>
		<tr>
			<td><?php echo h($funcionario->nome) ?></td>
			<td><?php echo h($funcionario->cpf) ?></td>
			<td><?php echo h($funcionario->matricula) ?></td>
			<td><?php echo h($funcionario->salario) ?></td>
			<td><?php echo h($funcionario->fotos->id) ?></td>
			<td><?php echo h($funcionario->cursos) ?></td>
			<td><?php echo $this->Form->postLink('Cursos', ['action' => 'cursos'])?></td>
		</tr>		
		<?php
			}
		}
		?>
	</tbody>
</table>
<?php debug($this->request->session()->read()); ?>
