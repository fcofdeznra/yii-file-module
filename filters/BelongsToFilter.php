<?php

class BelongsToFilter extends CFilter
{
	public $ownerIdProperty;
	public $ownerClass;
	public $allowExpression;
	
	protected function preFilter($filterChain)
	{
		if(!isset($_GET[$this->ownerIdProperty]))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		$ownerIdValue=$_GET[$this->ownerIdProperty];
		
		eval("\$owner={$this->ownerClass}::model()->findByPk(\$ownerIdValue);");
		if(!$owner)
			throw new CHttpException(404,'The requested page does not exist.');
		
		if(!eval("return {$this->allowExpression};"))
			throw new CHttpException(403,'You are not authorized to perform this action.');
		
		return true;
	}
}