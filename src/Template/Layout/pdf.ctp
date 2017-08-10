<table>
	<tr>
		<td><?php echo $this->Html->image('prodemge-logo.png') ?></td>
	</tr>
</table>
<hr>
<?php
echo $this->fetch('content');

$mpdf = new mPDF();

//Retorna o conteúdo do buffer de saída
$conteudoHtml = ob_get_contents();

// Passa o buffer da pagina para o mPDF
$mpdf->WriteHTML($conteudoHtml);

// Saida do PDF, Caso o usuário deseja salvar esse será o nome padrão do arquivo, I define que será exibido no Navegador
$mpdf->Output((($titulo) ? $titulo : 'servicosDetran' ) . '.pdf','I');
exit();	