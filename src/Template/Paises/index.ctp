<script>
$(function(){
	$('a#btn-pesquisar-pais').on('click', function(){
		$('#form-pesquisar-pais').submit();
		return false;
	});
})
</script>
<?php
if( empty($pdf) ) {
	echo $this->Html->tag('h1', 'País');
	echo $this->Html->tag('div',
		$this->Html->link('Pesquisar', '#', ['id' => 'btn-pesquisar-pais', 'class' => 'btn btn-info']) .
		$this->Html->link('Novo', ['action' => 'cadastrar'], ['class' => 'btn btn-success']) .
		$this->Html->link('Exportar PDF', ['action' => 'index', 'pdf'], ['class' => 'btn btn-primary'])
	);
	echo $this->Form->create(null, ['id' => 'form-pesquisar-pais']);
	echo $this->Form->control('nome');
	echo $this->Form->end();
}
?>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>País</th>
			<th>Data de Criação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if( count($paises) > 0 ){
			foreach ( $paises as $indice => $pais ) {
		?>
		<tr>
			<td><?php echo h($pais->id) ?></td>
			<td><?php echo h($pais->nome) ?></td>
			<td><?php echo h($pais->created) ?></td>
			<td>
				<?php
				echo $this->Form->postLink('Editar', ['action' => 'editar'], ['class' => 'btn btn-primary', 'data' => ['id' => $pais->id]]);
				?>
			</td>
		</tr>		
		<?php
			}
		}
		?>
	</tbody>
</table>
