<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
// defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

define('YII_DEBUG',TRUE);
defined('YII_TRACE_LEVEL');
// include_once('emoji.php');

require_once($yii);

$attributes = array(
		'ak' => 'atV54I5hflatOH00IebtxSwR',
		'geotable_id' => '66526',
		'sn' => 'not use now',
);

$app = Yii::createWebApplication($config);

$detect = new Mobile_Detect;

Yii::app()->theme = 'v1';
$app->run();
?>