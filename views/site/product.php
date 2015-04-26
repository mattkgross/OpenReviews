<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Product Overview';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Product Name</div>
                <div class="panel-body">
                    Description
                </div>
            </div>
        </div>
    </div>
</div>
