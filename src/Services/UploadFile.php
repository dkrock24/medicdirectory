<?php

namespace Services;

use \AppBundle\Entity\Menu;

class UploadFile {
	
	/* @var $em \Doctrine\ORM\EntityManager */
	
    private $em;

    function __construct($em) {
        $this->em = $em;
    }
	
	public function getUploadRootDir()
	{
		// the absolute directory path where uploaded
		// documents should be saved
		return __DIR__.'/../../web/uploads/';
	}
	
	/**
	*
	* @param  $file tipo de archivo
	* @param  $path directorio donde se va a guardar el file
	* @param  $pre_fix frejido en el nombre del archivo
	*/
	public function startUploadFile($file, $path=false, $pre_fix=false)
	{
		
		if( isset($path) && !empty($path) )
		{
			$res = $this->checkDir($path);
			if( $res )
			{
				$path = $res."/";
			}
			else
			{
				return false;
			}
		}
		else
		{
			$path = $this->getUploadRootDir();
		}
		
		if( $this->check_base_64($file) )
		{
			//file_put_contents("images/".$filename, $data);
			$filename = $this->getUniqueName( $pre_fix ).".png";//"test.png";
			file_put_contents($path.$filename, $this->check_base_64($file));
		}
		else
		{
			
		}
		
		return $filename;
		
	}
	
	protected function check_base_64($img)
	{
		if( !empty($img) )
		{
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			if( $data )
			{
				return $data;
			}
		}
		return false;
	}
	
	public function checkDir($dir=false)
	{
		$dirname = trim( $dir, "/" );
		$dirname = $this->getUploadRootDir().$dirname;
		if (!file_exists( $dirname))
		{
			$d = mkdir( $dirname, 0777);
			if( $d )
			{
				//echo "The directory $dirname was successfully created.";
				return $d;
			}else{
				return false;
			}

		} else {
			return $dirname;
		}
	}

	public function getUniqueName( $pre_fix=false )
	{
		return $pre_fix.uniqid().time();
	} 

	public function deleteFile($pathFile, $path=false)
	{
		try
		{
			if( isset($path) && !empty($path) )
			{
				$dir = $dirname = trim( $path, "/" );
				$path = $this->getUploadRootDir().$dir."/".$pathFile;
			}else{
				$path = $this->getUploadRootDir().$pathFile;
			}
			unlink( $path );
			return true;
		}  
		catch (\Exception $e)
		{
			echo ( $e->getMessage() );
			return false;
		}
	}
	
	public function thumbnailImage($img, $path)
	{
		$images = new \Imagick($img);
		$image->thumbnailImage(100, 100);
		$images->writeImages();
	}
	
}
