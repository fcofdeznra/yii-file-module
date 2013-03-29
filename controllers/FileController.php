<?php

class FileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		$filters=array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
		if(isset($this->module->ownerIdProperty)
			&& isset($this->module->ownerClass)
			&& isset($this->module->allowExpression))
			array_push($filters, array(
				'BelongsToFilter',
				'ownerIdProperty'=>$this->module->ownerIdProperty,
				'ownerClass'=>$this->module->ownerClass,
				'allowExpression'=>$this->module->allowExpression,
			));
		return $filters;
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'index', 'upload', 'admin' and 'delete' actions
				'actions'=>array('index','upload','admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('File');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Uploads a file.
	 * If upload is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionUpload()
	{
		$model=new File;
	
		if(isset($_POST['File']))
		{
			$model->attributes=$_POST['File'];
			$model->file=CUploadedFile::getInstance($model, 'file');
			if($model->validate())
			{
				$model->name=$model->file->name;
				$model->extension=$model->file->extensionName;
				$model->type=$model->file->type;
				$model->size=$model->file->size;
				$model->save(false);
	
				mkdir($model->directoryPath);
				$model->file->saveAs($model->path);
	
				if($model->isImage())
				{
					mkdir($model->thumbnailDirectoryPath);
					Yii::app()->thumbnailer->generate($model->path,$model->thumbnailPath);
				}
	
				$this->redirect(array('index'));
			}
		}
	
		$this->render('upload',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new File('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['File']))
			$model->attributes=$_GET['File'];
	
		$this->render('admin',array(
				'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		
		unlink($model->path);
		rmdir($model->directoryPath);
		
		if($model->isImage())
		{
			unlink($model->thumbnailPath);
			rmdir($model->thumbnailDirectoryPath);
		}
		
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return File the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=File::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param File $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function createUrl($route,$params=array(),$ampersand='&')
	{
		if(isset($this->module->ownerIdProperty) && $route!='' && $route[0]!=='/')
			$params[$this->module->ownerIdProperty]=$_GET[$this->module->ownerIdProperty];
		return parent::createUrl($route,$params,$ampersand);
	}
}
