<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Browse';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php if(isset($_GET["q"])) {
        echo "You searched for: ".$_GET["q"];
    }
    ?>

    <p></p>
</div>
