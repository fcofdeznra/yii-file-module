<?php
/* @var $this FileController */
/* @var $model File */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	'Upload',
);

$this->menu=array(
	array('label'=>'List File', 'url'=>array('index')),
	array('label'=>'Manage File', 'url'=>array('admin')),
);
?>

<h1>Upload File</h1>

<?php $this->renderPartial('_upload', array(
	'model'=>$model,
)); ?>
