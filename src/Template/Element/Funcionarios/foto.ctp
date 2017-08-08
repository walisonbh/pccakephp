<script>
$(function(){
	$('a#enviar-foto').on('click', function(){
		var formData = new FormData();
		formData.append('foto', $('#foto-input')[0].files[0]);
		formData.append('uuid', $('input[name=uuid]').val());
		$('a#enviar-foto').html('Enviando...');

		$.ajax({
			url: '<?php echo $this->Url->build('/funcionarios/ajaxUploadImagem/') ?>',
			type: 'POST',
			dataType: 'json',
			data: formData,
			success: function (data) {
//				$('#input-funcionario-imagem').val(data.resposta.foto);
				$('#funcionario-imagem').attr('src', 'data:image/jpeg;base64,' + data.resposta.bytes);
				$('a#enviar-foto').html('Enviar Imagem').attr('disabled', false);
				$('#foto-input').val('');
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
});
</script>
<h2>Foto</h2>
<?php
echo $this->Html->link('Enviar Imagem', '#', ['id' => 'enviar-foto', 'class' => 'btn btn-primary']);
echo $this->Html->tag('div', $this->Html->image('cake-logo.png', ['id' => 'funcionario-imagem', 'class' => "img-rounded"]));
//echo $this->Form->hidden('foto', ['id' => 'input-funcionario-imagem']);
echo $this->Form->file('foto_', ['id' => 'foto-input']);
