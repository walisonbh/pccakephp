<script>
$(function(){
	$('#logradouros-cep').on('keyup', function(){
		if( $(this).val().length == 8 ) {
			$.post('<?php echo $this->Url->build('/logradouros/ajax-pesquisar-logradouro-por-cep/') ?>', {cep : $(this).val()}, function(data){
				var newData = $.parseJSON(data);

				$('#endereco-id').val(newData.id);
				$('#endereco-logradouro').html(newData.logradouro);
				$('#endereco-bairro').html(newData.bairro);
				$('#endereco-cidade').html(newData.cidade);
				$('#endereco-estado').html(newData.estado);
			}).fail(function() {
				alert( "Nenhum endereço encontrado com os dados informados." );
			});
		}
	});
});
</script>
<h2>Endereço</h2>
<?php
echo $this->Form->hidden('funcionarios_logradouros.logradouro_id', ['id' => 'endereco-id']);
echo $this->Form->control('cep', ['label' => 'CEP', 'id' => 'logradouros-cep']);
?>
<dl>
	<dt>Logradouro</dt>
	<dd id="endereco-logradouro">...</dd>
	<dt>Bairro</dt>
	<dd id="endereco-bairro">...</dd>
	<dt>Cidade</dt>
	<dd id="endereco-cidade">...</dd>
	<dt>Estado</dt>
	<dd id="endereco-estado">...</dd>
</dl>