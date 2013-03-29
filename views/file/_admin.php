<?php
/* @var $this FileController */
/* @var $model File */

Yii::app()->clientScript->registerScript('die-click',<<<EOT
$('#file-grid a.delete').die('click');
EOT
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#file-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
"); ?>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'file-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'extension',
		array(
			'name'=>'size',
			'header'=>'Size (bytes)',
			'value'=>'Yii::app()->numberFormatter->format("#,##0",$data->size)',
		),
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'view'=>array(
					'url'=>'$data->url',
					'options'=>array(
						'target'=>'_blank',
					),
				),
				'update'=>array(
					'visible'=>'false',
				),
			),
		),
	),
)); ?>
