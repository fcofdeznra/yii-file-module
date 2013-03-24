<?php

class CountEventsActiveRecordBehavior extends CActiveRecordBehavior
{
	public function events()
	{
		return array_merge(parent::events(), array(
			'onBeforeCount'=>'beforeCount',
			'onAfterCount'=>'afterCount',
		));
	}
	
	protected function beforeCount($event)
	{
	}
	
	protected function afterCount($event)
	{
	}
}