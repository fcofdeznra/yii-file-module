<?php

class Plupload extends CWidget
{
	public $path;
	
	public function run()
	{
		$url=Yii::app()->assetManager->publish($this->path);
		Yii::app()->clientScript->registerCssFile($url.'/js/jquery.plupload.queue/css/jquery.plupload.queue.css');
		Yii::app()->clientScript->registerCoreScript('jquery.js');
		Yii::app()->clientScript->registerScriptFile($url.'/js/plupload.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile($url.'/js/plupload.flash.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile($url.'/js/plupload.html4.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile($url.'/js/plupload.html5.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile($url.'/js/jquery.plupload.queue/jquery.plupload.queue.js', CClientScript::POS_HEAD);
		
		Yii::app()->clientScript->registerScript($this->id.'_plupload', <<<EOT
$("#{$this->id}").pluploadQueue({
	runtimes : 'flash,html5,html4',
	flash_swf_url : '$url/js/plupload.flash.swf',
});
EOT
		, CClientScript::POS_READY);
		
		echo <<<EOT
<div id="{$this->id}">
	You browser doesn't support simple upload forms. Are you using Lynx?
</div>
EOT
		;
	}
}