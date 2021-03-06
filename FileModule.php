<?php

class FileModule extends CWebModule
{
	public $filesPath;
	public $thumbnailsPath;
	public $filesUrl;
	public $thumbnailsUrl;
	public $iconsUrl;
	public $validatorProperties=array();
	
	public $ownerIdProperty;
	public $ownerClass;
	public $allowExpression;
	
	public $quota;
	
	public $fileSelectedCallback='function(fileUrl){}';
	public $fileSelectedCallbackPath;
	
	public $pluploadPath;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'file.models.*',
			'file.components.*',
			'file.filters.*',
			'file.validators.*',
			'file.widgets.*',
		));
		
		if(isset($this->fileSelectedCallbackPath))
		{
			$this->fileSelectedCallbackPath=Yii::app()->basePath.DIRECTORY_SEPARATOR.$this->fileSelectedCallbackPath;
			
			$file=fopen($this->fileSelectedCallbackPath, "r");
			$this->fileSelectedCallback=fread($file, filesize($this->fileSelectedCallbackPath));
			fclose($file);
		}
		
		$this->pluploadPath=Yii::app()->basePath.DIRECTORY_SEPARATOR.$this->pluploadPath;
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
