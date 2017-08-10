<table style="width: 100%; border-spacing: 0; border-collapse: separate;">
	<thead>
		<tr>
			<th style="text-align: left">ID</th>
			<th style="text-align: left">País</th>
			<th style="text-align: left">Data de Criação</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if( count($paises) > 0 ){
			foreach ( $paises as $indice => $pais ) {
		?>
		<tr>
			<td style="border-top: 1px solid #999"><?php echo h($pais->id) ?></td>
			<td style="border-top: 1px solid #999"><?php echo h($pais->nome) ?></td>
			<td style="border-top: 1px solid #999"><?php echo h($pais->created->format('d/m/y h:i')) ?></td>
		</tr>		
		<?php
			}
		}
		?>
	</tbody>
</table>