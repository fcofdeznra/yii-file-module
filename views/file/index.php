<?php
/* @var $this FileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Files',
);

$this->menu=array(
	array('label'=>'Upload File', 'url'=>array('upload')),
	array('label'=>'Manage File', 'url'=>array('admin')),
);
?>

<h1>Files</h1>

<?php $this->renderPartial('_index', array(
	'dataProvider'=>$dataProvider,
)); ?>
