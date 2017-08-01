<script>
function adicionarEstado(numeroEstado, numeroCidade){
	var estado = '' +
	'<div class="row">' +
	'	<div class="col-lg-6">' +
	'		<div class="estado">' +
	'			<div class="form-group text required">' +
	'				<label class="control-label" for="estados-' + numeroEstado + '-nome">Nome</label>' +
	'				<div class="input-group">' +
	'					<input name="estados[' + numeroEstado + '][nome]" class="form-control" placeholder="Nome do stado" required="required" maxlength="50" id="estados-' + numeroEstado + '-nome" type="text">' +
	'					<span class="input-group-btn"><button class="btn-excluir-estado btn btn-danger" type="submit">Excluir Estado</button></span>' +
	'				</div>' +
	'			</div>' +
	'		</div>' +
	'	</div>' +
	'	<div class="col-lg-6">' +
	'		<div><a href="#" class="btn btn-success btn-xs btn-adicionar-cidade">Adicionar Cidade</a></div>' +
	'		<div class="cidade">' +
	'		<div class="form-group text required">' +
	'			<label class="control-label" for="estados-' + numeroEstado + '-cidades-' + numeroCidade + '-nome">Nome</label>' +
	'			<div class="input-group"><input name="estados[' + numeroEstado + '][cidades][' + numeroCidade + '][nome]" class="form-control" placeholder="Nome da Cidade" required="required" maxlength="50" id="estados-' + numeroEstado + '-cidades-' + numeroCidade + '-nome" type="text">' +
	'				<span class="input-group-btn"><button class="btn-excluir-cidade btn btn-danger" type="submit">Excluir Cidade</button></span>' +
	'			</div>' +
	'		</div>' +
	'		</div>' +
	'	</div>' +
	'</div>';

	return estado;
}

function adicionarCidade(numeroEstado, numeroCidade){
	var cidade = '' +
	'<div class="cidade">' +
	'	<div class="form-group text required">' +
	'		<div class="input-group">' +
	'			<input name="estados[' + numeroEstado + '][cidades][' + numeroCidade + '][nome]" class="form-control" placeholder="Nome da Cidade" required="required" id="estados-numeroestado-cidades-numeromunicipio-nome" type="text">' +
	'			<span class="input-group-btn"><button class="btn-excluir-cidade btn btn-danger" type="submit">Excluir Cidade</button></span>' +
	'		</div>' +
	'	</div>' +
	'</div>';

	return cidade;
}

$(function(){
	var quantidadeEstado = 0;
	var quantidadeCidade = 0;
	
	$('body').on('click', '.btn-adicionar-estado', function(){
		quantidadeEstado++;
		$("#linhas-estados-cidades").append(adicionarEstado(quantidadeEstado, quantidadeCidade));
		return false;
	});

	$('body').on('click', '.btn-adicionar-cidade', function(){
		quantidadeCidade++;
		$(this).parent().parent().append(adicionarCidade(quantidadeEstado, quantidadeCidade));
		return false;
	});

	$('body').on('click', '.btn-excluir-estado', function(){
//		$(this).parent().parent().parent().parent().parent().parent().remove();
		$(this).parents('.row').remove();
		return false;
	});
	
	$('body').on('click', '.btn-excluir-cidade', function(){
		$(this).parents('.cidade').remove();
		return false;
	});
});
</script>

<h1>País</h1>
<?php echo $this->Form->create($pais, ['id' => 'form-salvar-pais']); ?>
<div>
	<?php
	echo $this->Form->button('Salvar', ['class' => 'btn btn-primary']);
	echo $this->Html->link('Novo', ['action' => 'cadastrar'], ['class' => 'btn btn-success']);
	echo $this->Html->link('Apagar', ['action' => 'index'], ['class' => 'btn btn-danger']);
	echo $this->Html->link('Abrir', ['action' => 'index'], ['class' => 'btn btn-info']);
	?>
</div>
<?php echo $this->Form->control('nome', ['placeholder' => 'Nome do País']); ?>
<div class="row">
	<div class="col-lg-6">
		<?php echo $this->Html->link('Adicionar Estado', '#', ['class' => 'btn btn-success btn-xs btn-adicionar-estado']); ?>
	</div>
	<div class="col-lg-6"></div>
</div>
<div id="linhas-estados-cidades">
	<?php
	if( count($pais->estados) > 0 ){
		foreach( $pais->estados as $indice => $estado ){
	?>
	<div class="row">
		<div class="col-lg-6">
			<div class="estado"><?php echo $this->Form->control('estados.' . $indice . '.nome', ['placeholder' => 'Nome do stado', 'append' => $this->Form->button('Excluir Estado', ['class' => 'btn-excluir-estado btn-danger'])]); ?></div>
		</div>
		<div class="col-lg-6">
			<div><?php echo $this->Html->link('Adicionar Cidade', '#', ['class' => 'btn btn-success btn-xs btn-adicionar-cidade']); ?></div>
			<?php
			if( count($estado->cidades) > 0 ){
				foreach($estado->cidades as $indice1 => $cidades ){
			?>
			<div class="cidade"><?php echo $this->Form->control('estados.' . $indice . '.cidades.' . $indice1 . '.nome', ['placeholder' => 'Nome da Cidade', 'append' => $this->Form->button('Excluir Cidade', ['class' => 'btn-excluir-cidade btn-danger'])]); ?></div>
			<?php
				}
			}
			?>
		</div>
	</div>	
	<?php
		}
	}
	?>
</div>
<?php echo $this->Form->end(); ?>
