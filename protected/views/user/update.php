<?php
$this->breadcrumbs=array(
	Yii::t('app','page.users')=>array('index'),
	Yii::t('app','user.update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','user.list'),'url'=>array('index')),
	array('label'=>Yii::t('app','user.create'),'url'=>array('create')),
);
?>

<h1><?php echo Yii::t('app','user.update') . ' ' . $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<h2><?php echo Yii::t('app','page.domains'); ?></h2>

<div class="form">

<?php 
	$domainUser=new DomainUser;
	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'permission-form',
	'action'=>$this->createURL('domainUser/create', array('returnUrl'=>$this->createURL('user/update', array('id'=>$model->id)))),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($domainUser); ?>
	
	<?php echo $form->hiddenField($domainUser, 'user_id', array('value'=>$model->id));?>
	
	<div class="row">
		<?php echo $form->labelEx($domainUser,'domain_id'); ?>
		<?php 
		$models = Domain::model()->findAllBySql('SELECT * FROM `domains` WHERE `domains`.`id` NOT IN (SELECT `domain_id` FROM `domain_user` WHERE `user_id` = ' . $model->id . ') ORDER BY `domains`.`name`');
		echo $form->dropDownList($domainUser,'domain_id', CHtml::listData($models, 'id', 'name')); 
		?>
		<?php echo $form->error($domainUser,'domain_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app','page.add')); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'domain-grid',
	'dataProvider'=>new CArrayDataProvider($model->domains, array(
                'pagination'=>array(
                'pageSize'=>Yii::app()->settings->recordsPerPage,),
        )),
	'columns'=>array(
		array(
			'name'=>'name',
			'header'=>Yii::t('app','domain.name'),
			),
		array(
			'name'=>'type',
			'header'=>Yii::t('app','domain.type'),
			),
		array(
			'name'=>'master',
			'header'=>Yii::t('app','domain.masterIP'),
			),
		array(
			'name'=>'last_check',
			'header'=>Yii::t('app','domain.lastCheck'),
			'value'=>'date("Y-m-d H:i:s", $data->last_check)'
			),
		array(
			'class' => 'CButtonColumn',
	        'buttons' => array(
				'update' => array(
					'url' => 'Yii::app()->createUrl("domain/update", array("id" => $data[\'id\']))',
				),    // update button
				// TODO: after completion, this button should reload the add-domain form
				'delete' => array(
					'url' => 'Yii::app()->createUrl("domainUser/delete", array("user_id" => ' . $model->id . ', "domain_id" => $data[\'id\']))',
				),    // delete button 
				
			),
			'template'=>'{update}{delete}',
		),		
	),
)); ?>