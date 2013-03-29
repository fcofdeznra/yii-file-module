<?php
/* @var $this FileController */
/* @var $data File */
?>

<div class="file_list_item view" style="width: 128px; float: left; margin-right: 10px; cursor: pointer;" onClick="fileSelected('<?php echo $data->url; ?>')">

	<?php echo CHtml::image($data->thumbnailOrIconUrl, '', array('style'=>'width: 128px;')); ?>

	<div style="width: 128px; white-space: nowrap; overflow: hidden;">
		<?php echo CHtml::encode($data->name); ?>
		<br />
		<?php echo Yii::app()->numberFormatter->format('#,##0', $data->size).' bytes'; ?>
	</div>

</div>