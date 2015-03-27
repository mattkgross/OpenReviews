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

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>
                <div class="panel-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Filters</div>
                <div class="panel-body"></div>
            </div>
        </div>
    </div>
</div>
