<?php
echo $this->Html->tag('h1', 'País');
echo $this->Html->tag('div', $this->Html->link('Pesquisar', '#', ['class' => 'btn btn-info']) . $this->Html->link('Novo', ['action' => 'cadastrar'], ['class' => 'btn btn-success']) . $this->Html->link('Exportar PDF', ['action' => 'index', 'pdf'], ['class' => 'btn btn-primary']));
echo $this->Form->create();
echo $this->Form->control('pais');
echo $this->Form->end();
?>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>País</th>
			<th>Data de Criação</th>
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
		</tr>		
		<?php
			}
		}
		?>
	</tbody>
</table>
