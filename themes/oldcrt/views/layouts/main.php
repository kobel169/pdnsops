<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/oldcrt/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/oldcrt/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/oldcrt/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/oldcrt/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/oldcrt/form.css" />
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/oldcrt/gridview.css'); ?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/oldcrt/pager.css'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">


	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>Yii::t('app','page.home'), 'url'=>array('/site/index')),
				array('label'=>Yii::t('app','page.domains'), 'url'=>array('/domain/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('app','page.users'), 'url'=>array('/user/index'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->getState('isAdmin')),
				array('label'=>Yii::t('app','page.logs'), 'url'=>array('/log/index'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->getState('isAdmin')),
				array('label'=>Yii::t('app','page.supermasters'), 'url'=>array('/supermaster/index'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->getState('isAdmin')),
				array('label'=>Yii::t('app','page.settings'), 'url'=>array('/site/settings'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->getState('isAdmin')),
				array('label'=>Yii::t('app','page.login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('app','page.logout'). ' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo Yii::t('app', 'page.footer'); ?>
		<?php echo date('Y'); ?> - <?php echo Yii::t('app', 'page.team'); ?><br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
