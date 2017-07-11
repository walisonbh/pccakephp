<script>
function linhaTabelaAnexos(identificador, nome, formato, data, ver){
	var linhaTabela = "" + 
		"<tr>" +
		"	<td>" + nome + "</td>" +
		"	<td>" + formato + "</td>" +
		"	<td>" + data + "</td>" +
		"	<td><img src=\"data:image/jpeg;base64," + ver + "\" height=\"60\"/></td>" +
		"	<td class=\"text-center\">" +
		"		<a href=\"<?php echo $this->Url->build('/funcionarios/baixar-anexo/') ?>"  + identificador + "\" id=\"anexos-baixar-" + identificador + "\" class=\"btn btn-primary\">Baixar</a>" +
		"		<a href=\"#\" id=\"anexos-apagar-" + identificador + "\"  class=\"btn btn-danger\">Apagar</a>" +
		"	</td>" +
		"</tr>";

	return linhaTabela;
}
$(function(){
	$('#salvar-memorando, #salvar-oficio').on('click', function(){
		var formData = new FormData();
		
		if( $('#memorando-bytes').val() ) {
			formData.append('foto', $('#memorando-bytes')[0].files[0]);
			formData.append('uuid', $('input[name=uuid]').val());
			formData.append('anexotipo', 'memorando');
			var modal = '#salvar-memorando';
			var tabela = '#tabela-memorando';
		}else{
			formData.append('foto', $('#oficio-bytes')[0].files[0]);
			formData.append('uuid', $('input[name=uuid]').val());
			formData.append('anexotipo', 'oficio');
			var modal = '#salvar-oficio';
			var tabela = '#tabela-oficio';
		}

		$('a#enviar-foto').html('Enviando...');

		$.ajax({
			url: '<?php echo $this->Url->build('/funcionarios/ajaxUploadAnexos/') ?>',
			type: 'POST',
			dataType: 'json',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$('#input-funcionario-imagem').val(data.resposta.foto);
				$('a#enviar-foto').html('Enviar Imagem').attr('disabled', false);
				$('#memorando-bytes').val('');
				$('#oficio-bytes').val('');
				$(modal).modal('hide');
				$(tabela).append(linhaTabelaAnexos(data.resposta.uuida, data.resposta.nome, data.resposta.formato, data.resposta.data, data.resposta.bytes));
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert($.parseJSON(jqXHR.responseText).resposta.erro.mensagem);
				$('a#enviar-foto').html('Enviar Imagem').attr('disabled', false);
			},
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

	$('body').on('click', 'a[id^=anexos-apagar-]', function(){
		var dadosApagar = this.id.split('-');
		var apagar = this;
		$.post('<?php echo $this->Url->build('/funcionarios/ajax-apagar-anexos/') ?>', {uuid: $('input[name=uuid]').val(), id: dadosApagar[2]}, function(data){
			$(apagar).parent().parent().remove();
		}).fail(function() {
			alert( "O anexo informado não existe." );
		});
	});
});
</script>
<h2>Anexos</h2>
<h3>Memorando</h3>
<?php echo $this->Html->link('Novo', '#', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#modal-memorando']); ?>
<table id="tabela-memorando" class="table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Formato</th>
			<th>Data</th>
			<th>Ver</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if( count($memorandos) > 0 ) {
			foreach( $memorandos as $indice1 => $memorando ) {
		?>
		<tr>
			<td><?php echo $memorando->nome ?></td>
			<td><?php echo $memorando->formato ?></td>
			<td><?php echo $memorando->created ?></td>
			<td><?php echo $memorando->id ?></td>
			<td class="text-center">
				<?php
				echo $this->Html->link('Baixar', ['action' => 'baixar-anexo', $memorando->id], ['id' => 'baixar-' . $memorando->id, 'class' => 'btn btn-primary']);
				echo $this->Html->link('apagar', '#', ['id' => 'apagar-' . $memorando->id, 'class' => 'btn btn-danger']);
				?>
			</td>
		</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>
<h3>Ofício</h3>
<?php echo $this->Html->link('Novo', '#', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#modal-oficio']); ?>
<table id="tabela-oficio" class="table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Formato</th>
			<th>Data</th>
			<th>Ver</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if( count($oficios) > 0 ) {
			foreach( $oficios as $indice2 => $oficio ) {
		?>
		<tr>
			<td><?php echo $oficio->nome ?></td>
			<td><?php echo $oficio->formato ?></td>
			<td><?php echo $oficio->created ?></td>
			<td><?php echo $oficio->id ?></td>
			<td class="text-center">
				<?php
				echo $this->Html->link('Baixar', ['action' => 'baixar-anexo', $oficio->id], ['id' => 'anexos-baixar-' . $oficio->id, 'class' => 'btn btn-primary']);
				echo $this->Html->link('Apagar', '#', ['id' => 'anexos-apagar-' . $oficio->id, 'class' => 'btn btn-danger']);
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
// Modal Memorando
echo $this->Modal->create("Adicionar Memorando", ['id' => 'modal-memorando']);

echo $this->Form->file('memorando_', ['id' => 'memorando-bytes']);

echo $this->Modal->end([
	$this->Html->link('Salvar', '#', ['class' => 'btn btn-primary', 'bootstrap-type' => 'primary', 'id' => 'salvar-memorando']),
	$this->Html->link('Cancelar', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])
]);

// Modal Oficio
echo $this->Modal->create("Adicionar Ofício", ['id' => 'modal-oficio']);

echo $this->Form->file('oficio_', ['id' => 'oficio-bytes']);

echo $this->Modal->end([
	$this->Html->link('Salvar', '#', ['class' => 'btn btn-primary', 'bootstrap-type' => 'primary', 'id' => 'salvar-oficio']),
	$this->Html->link('Cancelar', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal'])
]);
?>