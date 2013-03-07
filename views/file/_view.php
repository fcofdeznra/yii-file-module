<?php
/* @var $this FileController */
/* @var $data File */
?>

<div class="view" style="width: 128px; float: left; margin-right: 10px;">

	<?php $thumbnail=CHtml::image($data->thumbnailOrIconUrl, '', array('style'=>'width: 128px;'));
	echo CHtml::link($thumbnail, $data->url, array('target'=>'_blank')); ?>

	<div style="width: 128px; white-space: nowrap; overflow: hidden;">
		<?php echo CHtml::encode($data->name); ?>
		<br />
		<?php echo Yii::app()->numberFormatter->format('#,##0', $data->size).' bytes'; ?>
	</div>

</div>