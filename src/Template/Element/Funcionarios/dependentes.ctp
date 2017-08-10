<script>
function linhaTabelaDependentes(identificador, nome, ver){
	var linhaTabela = "" + 
		"<tr>" +
		"	<td class=\"dependentes-nome\">" + nome + "</td>" +
		"	<td class=\"dependentes-arquivo\"><img src=\"data:image/jpeg;base64," + ver + "\" height=\"60\"/></td>" +
		"	<td class=\"text-center\">" +
		"		<a href=\"#\" id=\"dependentes-editar-" + identificador + "\" class=\"btn btn-primary\">Editar</a>" +
		"		<a href=\"#\" id=\"dependentes-apagar-" + identificador + "\"  class=\"btn btn-danger\">Apagar</a>" +
		"	</td>" +
		"</tr>";

	return linhaTabela;
}
$(function(){
	$('#salvar-dependente').on('click', function(){
		var dependenteId = $('#dependentes-id').val();
		var formData = new FormData();
		if( dependenteId != "" )
			formData.append('id', $('#dependentes-id').val());
		formData.append('nome', $('#dependentes-nome').val());
		formData.append('foto', $('#dependentes-bytes')[0].files[0]);
		formData.append('uuid', $('input[name=uuid]').val());
		$('a#enviar-foto').html('Enviando...');

		$.ajax({
			url: '<?php echo $this->Url->build('/funcionarios/ajaxUploadDependentes/') ?>',
			type: 'POST',
			dataType: 'json',
			data: formData,
			success: function (data) {
				if( dependenteId != "" )
					$('#dependentes-editar-' + dependenteId).parent().parent().remove();

				$('#input-funcionario-imagem').val(data.resposta.foto);
				$('a#enviar-foto').html('Enviar Imagem').attr('disabled', false);
				$('#dependentes-id, #dependentes-nome, #dependentes-bytes').val('');
				$('#modal-dependentes').modal('hide');
				$('#tabela-dependentes').append(linhaTabelaDependentes(data.resposta.uuidd, data.resposta.nome, data.resposta.bytes));
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert($.parseJSON(jqXHR.responseText).resposta.erro.mensagem);
				$('a#enviar-foto').html('Enviar Imagem').attr('disabled', false);
			},
			cache: false,
			contentType: false,
			processData: false,
			xhr: function () {  // Custom XMLHttpRequest
				var myXhr = $.ajaxSettings.xhr();
				if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
					myXhr.upload.addEventListener('progress', function (event) {
						/* faz alguma coisa durante o progresso do upload */
						if (event.lengthComputable) {
							var percentComplete = (event.loaded / event.total) * 100;
							$('a#enviar-foto').html('Enviando... ' + parseFloat(percentComplete.toFixed(2)) + '%').attr('disabled', true);
						} else {
							// Não é possível calcular informações de progresso uma vez que a dimensão total é desconhecida
							console.log('Não é possível calcular informações de progresso uma vez que a dimensão total é desconhecida');
						}
					}, false);
				}
				return myXhr;
			}
		});
	});

	$('body').on('click', 'a[id^=dependentes-apagar-]', function(){
		var dadosApagar = this.id.split('-');
		var apagar = this;
		$.post('<?php echo $this->Url->build('/funcionarios/ajax-apagar-dependentes/') ?>', {uuid: $('input[name=uuid]').val(), id: dadosApagar[2]}, function(data){
			$(apagar).parent().parent().remove();
		}).fail(function() {
			alert( "O dependente informado não existe." );
		});
	});

	$('body').on('click', 'a[id^=dependentes-editar-]', function(){
		var dadosEditar = this.id.split('-');
		var elemento = $(this).parent().parent();
		$('#dependentes-id').val(dadosEditar[2]);
		$('#dependentes-nome').val($(elemento[0]).find('td.dependentes-nome').html());
		$('#modal-dependentes').modal('show');
	});
});
</script>
<h2>Dependentes</h2>
<?php echo $this->Html->link('Novo', '#', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#modal-dependentes']); ?>
<table id="tabela-dependentes" class="table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Ver</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if( isset($dependentes) && count($dependentes) > 0 ){
			foreach( $dependentes as $indice0 => $dependente ){
		?>
		<tr>
			<td class="dependentes-nome"><?php echo $dependente->nome ?></td>
			<td class="dependentes-arquivo"><?php echo $this->Html->image('data:image/png;base64,' . base64_encode(@stream_get_contents($dependente->bytes)), ['alt' => 'Foto', 'Title' => 'Foto', 'width' => '100']) ?></td>
			<td class="text-center">
				<?php
				echo $this->Html->link('Editar', '#', ['id' => 'dependentes-editar-' . $indice0, 'class' => 'btn btn-primary']);
				echo $this->Html->link('Apagar', '#', ['id' => 'dependentes-apagar-' . $indice0, 'class' => 'btn btn-danger']);
				echo $this->Form->hidden('dependentes.' . $indice0 . '.id');
				?>
			</td>
		</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>
<?php
echo $this->Modal->create("Adicionar Dependentes", ['id' => 'modal-dependentes']);

echo $this->Form->hidden('dependentes_.id_', ['id' => 'dependentes-id']);
echo $this->Form->control('dependentes_.nome_', ['id' => 'dependentes-nome']);
echo $this->Form->file('dependentes_.bytes_', ['id' => 'dependentes-bytes']);

echo $this->Modal->end([
	$this->Html->link('Salvar', '#', ['class' => 'btn btn-primary', 'bootstrap-type' => 'primary', 'id' => 'salvar-dependente']),
	$this->Html->link('Cancelar', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])
]);