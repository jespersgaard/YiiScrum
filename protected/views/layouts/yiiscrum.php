<?php /* @var $this Controller */ ?>
<!DOCTYPE html >
<html lang="en" ng-app>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/angular.min.js" ></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/myfunc.js" ></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container wrapper" id="page">

    <div class="navbar navbar-fixed-top">
        <?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'brand' => CHtml::encode(Yii::app()->name),
            'fixed' => true,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Home', 'url' => array('/site/index')),
                        array('label' => 'Projects', 'url' => array('/project/index')),
                        array('label' => 'Users', 'url' => array('/user/view')),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    )
                )


            ),
        )); ?>
    </div>

    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php echo $content; ?>


    <div id="push"></div>

</div>


<div class="hero-unit footer">
    <p> Copyright &copy; <?php echo date('Y'); ?> by Ákos Kiszely.
        All Rights Reserved.
        <?php echo Yii::powered(); ?>
    </p>
</div>


<!-- page -->

<script>
window.onload=init;
</script>

</body>
</html>
