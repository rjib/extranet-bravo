
<?php
require_once('Barcode.php');

/**
 * classe para gerar codigo de barra 128bits
 * @author Ricardo S. Alvarenga
 * @since 18/12/2012
 *
 */
class GerarCodigoDeBarra128{
	 
	public function __construct(){

	}
	/**
	 * Metodo para gerar o arquivo
	 * @param string $valor
	 * @param string $filename	caminho onde sera salvo o arquivo e nome mais extensao
	 * @since 18/12/2012
	 */
	
	public function gerar($valor, $filename){
		
		  $fontSize = 10;   // GD1 in px ; GD2 in point
		  $marge    = 10;   // between barcode and hri in pixel
		  $x        = 125;  // barcode center
		  $y        = 275;  // barcode center
		  $height   = 30;   // barcode height in 1D ; module size in 2D
		  $width    = 2;    // barcode height in 1D ; not use in 2D
		  $angle    = 180;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
		
		$code     = $valor; // barcode, of course ;)
		$type     = 'code128';
		
		
		// -------------------------------------------------- //
		//            ALLOCATE GD RESSOURCE
		// -------------------------------------------------- //
		$im     = imagecreatetruecolor(300, 300);
		$black  = ImageColorAllocate($im,0x00,0x00,0x00);
		$white  = ImageColorAllocate($im,0xff,0xff,0xff);
		$red    = ImageColorAllocate($im,0xff,0x00,0x00);
		$blue   = ImageColorAllocate($im,0x00,0x00,0xff);
		imagefilledrectangle($im, 0, 0, 300, 300, $white);
		
		// -------------------------------------------------- //
		//                      BARCODE
		// -------------------------------------------------- //
		$data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
		
		// -------------------------------------------------- //
		//                        HRI						  //	
		// -------------------------------------------------- //
		if ( isset($font) ){
			$box = imagettfbbox($fontSize, 0, $font, $data['hri']);
			$len = $box[2] - $box[0];
			Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
			imagettftext($im, $fontSize, $angle, $x + $xt, $y + $yt, $blue, $font, $data['hri']);
		}
		
		//header('Content-type: image/gif');
		imagegif($im,$filename);
		//imagegif($image,$this->file);
		imagedestroy($im);
	}

	 public function drawCross($im, $color, $x, $y){
			imageline($im, $x - 10, $y, $x + 10, $y, $color);
			imageline($im, $x, $y- 10, $x, $y + 10, $color);
	}
}

?>