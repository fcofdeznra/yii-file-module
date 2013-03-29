<?php
/* @var $this FileController */
?>

<h1>Files</h1>

<?php $this->widget('zii.widgets.jui.CJuiTabs', array(
	'id'=>'file-browser-tabs',
	'tabs'=>array(
		'List'=>array(
			'ajax'=>array('index'),
		),
		'Upload'=>array(
			'ajax'=>array('upload'),
		),
		'Manage'=>array(
			'ajax'=>array('admin'),
		),
	),
)); ?>