<?php
	class ImageHelper
	{
		var $images;
		var $lastname;
		var $lastext;
		function __construct()
		{
			$this->images=array();
			$this->lastname="source";
			$this->lastext="jpg";
		}
		
		function load($path,$name='source')
		{
			# Get image location
			$image_path = $path;
			
			# Load image
			$img=NULL;
			$ext = strtolower(end(explode('.', $image_path)));
			if ($ext == 'jpg' || $ext == 'jpeg') {
			    $img = @imagecreatefromjpeg($image_path);
			} else if ($ext == 'png') {
			    $img = @imagecreatefrompng($image_path);
			# Only if your version of GD includes GIF support
			} else if ($ext == 'gif') {
			    $img = @imagecreatefromgif($image_path);
			}
			//exit($ext);
			$this->lastext=$ext;
			$this->setImage($name, $img);
		}
		
		function getImage($name=false)
		{
			if($name!==false)
			{
				$this->lastName=$name;
			}
			$img=base_nulltest($this->images[$this->lastName],NULL);
			return $img;
		}
		
		function setImage($name,$img)
		{
			$this->lastName=$name;
			$this->images[$name]=$img;
		}
		
		function destoryImage($name)
		{
			$img=$this->getImage($name);
			if($img)
				imagedestroy($img);
		}
		
		function display($name=false)
		{
			$img=$this->getImage($name);
			switch($this->lastext)
			{
				case 'png':
					header("Content-type: image/png");
					imagepng($img);
					break;
				case 'gif':
					header("Content-type: image/gif");
					imagegif($img);
					break;
				default:
				case 'jpg':
				case 'jpeg':
					header("Content-type: image/jpeg");
					imagejpeg($img);
					break;
			}
		}
		
		function createThumbnail($twidth=100,$theight=100,$name='source',$thumbname='thumbnail',$scalefix=false)
		{
			$img=$this->getImage($name);
			# If an image was successfully loaded, test the image for size
			if ($img) {
		
			    # Get image size and scale ratio
			    $width = imagesx($img);
			    $height = imagesy($img);
				
			    $scale = min($twidth/$width, $theight/$height);
				if(!$scalefix)
					$scale = min($twidth/$width, $theight/$height);
				else
					$scale = max($twidth/$width, $theight/$height);
			    # If the image is larger than the max shrink it
			    if ($scale < 1) {
					$new_width = floor($scale*$width);
					$new_height = floor($scale*$height);
					
					# Create a new temporary image
					$tmp_img = imagecreatetruecolor($new_width, $new_height);
					
					# Copy and resize old image into new image
					imagecopyresized($tmp_img, $img, 0, 0, 0, 0,
						$new_width, $new_height, $width, $height);
					
					//imagedestroy($img);
					$img = $tmp_img;
				}
				else
				{
					//die('smaller');
				}
			    
			    $this->setImage($thumbname,$img);
			}
		}
		
		function toFile($path,$name=false)
		{
			$img=$this->getImage($name);
			if($img)
			{
				if(file_exists($path))
					unlink($path);
				switch($this->lastext)
				{
					case 'png':
						imagepng($img,$path);
						break;
					case 'gif':
						imagegif($img,$path);
						break;
					case 'jpg':
					case 'jpeg':
						imagejpeg($img,$path);
						break;
				}
			}
			else
			{
				//die('fail');
			}
			return false;
		}
	}
?>