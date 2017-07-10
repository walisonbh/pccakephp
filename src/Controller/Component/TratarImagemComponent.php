<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
/**
 * 
 * 
 * 
 * 
 * 
 */
class TratarImagemComponent extends Component
{
/**
 * 
 * 
 * 
 */
	public function redimencionarImagem($imagem, $largura, $altura)
	{
		$dstX = 0;
		$dstY = 0;
		$img = imagecreatefromstring($imagem);

		$x   = imagesx($img);
		$y   = imagesy($img);
		$alturaCalculada = ($largura * $y)/$x;

		// Calculando a posição da imagem sobre a imagem temporário
		if( $alturaCalculada < $altura )
			$dstY = ($altura - $alturaCalculada) / 2;

		// Cria a imagem temporaria
		$nova = imagecreatetruecolor($largura, $altura);

		imagecopyresampled($nova, $img, $dstX, $dstY, 0, 0, $largura, $alturaCalculada, $x, $y);

		ob_start();

		imagejpeg($nova);

		$final_image = ob_get_contents();

		ob_end_clean();

		imagedestroy($img);
		imagedestroy($nova);

		return $final_image;
	}
}