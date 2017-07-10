<h2>Formação</h2>
<?php echo $this->Form->button('Adicionar Curso', ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#myModal']); ?>
<table class="table">
	<thead>
		<tr>
			<th>Curso</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if( count($cursosFuncionario) > 0 ){
			foreach( $cursosFuncionario as $indice0 => $curso ){
		?>
		<tr>
			<td><?php echo $curso->nome ?></td>
			<td class="text-center" width="300">
				<?php echo $this->Html->link('Apagar', '#', ['class' => 'btn btn-danger']); ?>
			</td>
		</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>
<?php
echo $this->Modal->create("My Modal Form", ['id' => 'myModal', 'close' => false]);

echo $this->Form->control('cursos');

echo $this->Modal->end([
	$this->Form->button('Submit', ['bootstrap-type' => 'primary']),
	$this->Form->button('Close', ['data-dismiss' => 'modal'])
]);
?>