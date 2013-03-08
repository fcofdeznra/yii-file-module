<?php

class FileModule extends CWebModule
{
	public $filesPath;
	public $thumbnailsPath;
	public $filesUrl;
	public $thumbnailsUrl;
	public $iconsUrl;
	public $validatorProperties=array();
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'file.models.*',
			'file.components.*',
		));
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
