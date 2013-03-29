<?php
/* @var $this FileController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('zii.widgets.CListView', array(
	'id'=>'file-list',
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));

Yii::app()->clientScript->registerCss('pager',<<<EOT
.pager
{
	clear: both;
}
EOT
); ?>

<div class="clear"></div>

<?php Yii::app()->clientScript->registerScript('file-selected',<<<EOT
function fileSelected(fileUrl)
{
	var callback={$this->module->fileSelectedCallback};
	callback(fileUrl);
}
EOT
, CClientScript::POS_END); ?>
