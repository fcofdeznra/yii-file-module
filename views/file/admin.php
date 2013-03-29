<?php
/* @var $this FileController */
/* @var $model File */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List File', 'url'=>array('index')),
	array('label'=>'Upload File', 'url'=>array('upload')),
);
?>

<h1>Manage Files</h1>

<?php $this->renderPartial('_admin', array(
	'model'=>$model,
)); ?>
