<?php

class BelongsToBehavior extends CountEventsActiveRecordBehavior
{
	public $ownerIdProperty;
	
	public function beforeSave($event)
	{
		if(!isset($_GET[$this->ownerIdProperty]))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		$ownerIdValue=$_GET[$this->ownerIdProperty];
		
		$this->owner->{$this->ownerIdProperty}=$ownerIdValue;
	}
	
	public function beforeFind($event)
	{
		$this->beforeFindCount($event);
	}
	
	public function beforeCount($event)
	{
		$this->beforeFindCount($event);
	}
	
	private function beforeFindCount($event)
	{
		if(!isset($_GET[$this->ownerIdProperty]))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		$ownerIdValue=$_GET[$this->ownerIdProperty];
		
		$this->owner->dbCriteria->addCondition("{$this->ownerIdProperty}=:{$this->ownerIdProperty}");
		$this->owner->dbCriteria->params[":{$this->ownerIdProperty}"]=$ownerIdValue;
	}
}