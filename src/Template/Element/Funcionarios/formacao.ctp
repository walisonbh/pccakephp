<script>
function linhaTabelaCursos(identificador, nome){
	var linhaTabela = "" + 
		"<tr>" +
		"	<td class=\"cursos-nome\">" + nome + "</td>" +
		"	<td class=\"text-center\">" +
		"		<a href=\"#\" id=\"cursos-apagar-" + identificador + "\"  class=\"btn btn-danger\">Apagar</a>" +
		"		<input type=\"hidden\" name=\"funcionarios_cursos[" + identificador + "][curso_id]\" value=\"" + identificador + "\"/>" +
		"	</td>" +
		"</tr>";

	return linhaTabela;
}
$(function(){
	$('#salvar-curso').on('click', function(){
		if( $('#cursos option:selected').attr('value') == '' ) {
			alert('Ao menos um curso deve ser selecionado.');
			return;
		}
		$('#formacao tbody').append(linhaTabelaCursos($('#cursos option:selected').val(), $('#cursos option:selected').html()));
	});
	
	$('body').on('click', 'a[id^=cursos-apagar-]', function(){
		$(this).parent().parent().remove();
	});
});
</script>
<h2>Formação</h2>
<?php echo $this->Html->link('Adicionar Curso', '#', ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal-adicionar-cursos']); ?>
<table id="formacao" class="table">
	<thead>
		<tr>
			<th>Curso</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if( isset($funcionarioCursos) && count($funcionarioCursos) > 0 ){
			foreach( $funcionarioCursos as $indice0 => $curso ){
		?>
		<tr>
			<td><?php echo $curso->curso->nome ?></td>
			<td class="text-center" width="300">
				<?php echo $this->Html->link('Apagar', '#', ['id' => 'cursos-apagar-' . $curso->id, 'class' => 'btn btn-danger']); ?>
				<?php echo $this->Form->hidden('funcionarios_cursos.' . $indice0 . '.curso_id') ?>
			</td>
		</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>
<?php
echo $this->Modal->create("Adicionar Cursos", ['id' => 'modal-adicionar-cursos']);

echo $this->Form->control('cursos', ['empty' => true]);

echo $this->Modal->end([
	$this->Html->link('Salvar', '#', ['class' => 'btn btn-primary', 'bootstrap-type' => 'primary', 'id' => 'salvar-curso']),
	$this->Html->link('Cancelar', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])
]);
