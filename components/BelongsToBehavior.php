<?php

class BelongsToBehavior extends CActiveRecordBehavior
{
	public $ownerIdProperty;
	
	public function beforeSave($event)
	{
		$ownerIdProperty=$this->ownerIdProperty;
		if(!isset($_GET[$ownerIdProperty]))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		$ownerIdValue=$_GET[$ownerIdProperty];
		
		$this->owner->$ownerIdProperty=$ownerIdValue;
	}
	
	public function beforeFind($event)
	{
		$ownerIdProperty=$this->ownerIdProperty;
		if(!isset($_GET[$ownerIdProperty]))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		$ownerIdValue=$_GET[$ownerIdProperty];
		
		$this->owner->dbCriteria->addCondition($ownerIdProperty.'=:'.$ownerIdProperty);
		$this->owner->dbCriteria->params[':'.$ownerIdProperty]=$ownerIdValue;
	}
}