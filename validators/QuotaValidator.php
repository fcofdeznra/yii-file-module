<?php

class QuotaValidator extends CValidator
{
	public $quota;
	
	protected function validateAttribute($model, $attribute)
	{
		$file=$model->$attribute;
		
		$command=Yii::app()->db->createCommand()
			->select('SUM(size)')
			->from('file');
		if(isset(Yii::app()->controller->module->ownerIdProperty))
		{
			$ownerIdProperty=Yii::app()->controller->module->ownerIdProperty;
			$ownerIdValue=$_GET[$ownerIdProperty];
			$command->where("$ownerIdProperty=:$ownerIdProperty", array(":$ownerIdProperty"=>$ownerIdValue));
		}
		$used=$command->queryScalar();
		
		if($used+$file->size>$this->quota)
		{
			$free=$this->quota-$used;
			$model->addError($attribute, "Quota exceeded: {$this->quota} bytes total, $used bytes used, $free bytes free.");
		}
	}
}