<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Img_magnifier {
	//Must be called at least once
	public function render_script(){
		//SRC for js must be outside the codeigniter since you get 403 forbidden error if not outside (need public permission)
		echo '	<script src="http://datapi.com/jtantongco/scripts/popUpMagnifier/PopBoxDocumentation_files/PopBox.js" 
				type="text/javascript">
				</script>
				<script type="text/javascript">
				popBoxWaitImage.src = "http://datapi.com/jtantongco/scripts/popUpMagnifier/spinner40.gif";
				popBoxRevertImage = "http://datapi.com/jtantongco/scripts/popUpMagnifier/magminus.gif";
				popBoxPopImage = "http://datapi.com/jtantongco/scripts/popUpMagnifier/magplus.gif";
				</script> '; 
	}
	
	public function render_popImg($src,$caption,$id,$width,$height){
		echo 	' <img 	pbshowpopbar="true" 
						pbcaption="'.$caption.'"
						src="'.$src.'" 
						alt="" onclick="Pop(this,50,\'PopBoxImageLarge\');" 
						title="Click to magnify/shrink" 
						class="PopBoxImageSmall" 
						id="'.$id.'" 
						style="width: '.$width.'px;
						height: '.$height.'px;
						visibility: visible;">';
}