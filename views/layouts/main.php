<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
#use yii\bootstrap4\Nav;
#use yii\bootstrap4\NavBar;

AppAsset::register($this);
require_once ('../models/Calendar.php');

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
<!--    <link href="../css/style.css">-->
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100" >
<?php $this->beginBody() ?>
<div class="wrapper">
    <div>
        <div class="side-menu lock">
            <div class="logo"><img src="img/logo.svg" alt="logo"></div>
            <div class="menu">
                <a class="menu-item flex-row cursor">
                    <a href="<?= \yii\helpers\Url::to(['site/profile'])?>">
                        <img src="img/menu-item.svg" alt="menu-item" class="menu-item_img">
                        <div class="menu-item_text">Профиль</div>
                    </a>
                </a>
            </div>

            <div class="menu-item flex-row cursor">
                <img src="img/menu-item.svg" alt="menu-item" class="menu-item_img">
                <div class="menu-item_text">Отчеты</div>
            </div>

            <div class="menu-item flex-row cursor">
                <img src="img/menu-item.svg" alt="menu-item" class="menu-item_img">
                <div class="menu-item_text">Обсуждения</div>
            </div>

            <div class="menu-item flex-row cursor">
                <img src="img/menu-item.svg" alt="menu-item" class="menu-item_img">
                <div class="menu-item_text">Обсуждения</div>
            </div>

            <div class="exit flex-row cursor">
                <img src="img/exit.svg" alt="exit" class="exit_img">
                <div class="exit_text">Выйти</div>
            </div>
        </div>
    </div>
    <div class="container">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
