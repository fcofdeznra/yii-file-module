<?php

class CountEventsActiveRecord extends CActiveRecord
{
	public function onBeforeCount($event)
	{
		$this->raiseEvent('onBeforeCount',$event);
	}
	
	public function onAfterCount($event)
	{
		$this->raiseEvent('onAfterCount',$event);
	}
	
	protected function beforeCount()
	{
		if($this->hasEventHandler('onBeforeCount'))
		{
			$event=new CModelEvent($this);
			$this->onBeforeCount($event);
		}
	}
	
	protected function afterCount()
	{
		if($this->hasEventHandler('onAfterCount'))
			$this->onAfterCount(new CEvent($this));
	}
	
	public function count($condition='',$params=array())
	{
		$this->beforeCount();
		$count=parent::count($condition, $params);
		$this->afterCount();
		return $count;
	}
	
	public function countByAttributes($attributes,$condition='',$params=array())
	{
		$this->beforeCount();
		$count=parent::countByAttributes($attributes, $condition, $params);
		$this->afterCount();
		return $count;
	}
	
	public function countBySql($sql,$params=array())
	{
		$this->beforeCount();
		$count=parent::countBySql($sql, $params);
		$this->afterCount();
		return $count;
	}
}