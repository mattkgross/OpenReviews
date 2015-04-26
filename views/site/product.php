<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $product['name'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-4">
                    <h4>Description</h4>
                    <p><?php print $product['description'] ?></p>
                </div>
                <div class="col-md-4">
                    <h4>Website</h4>
                    <a href="<?php print $product['website'] ?>"><?php print $product['website'] ?></a>
                </div>
                <div class="col-md-4">
                    <h4>Supported Operating Systems</h4>
                    <p><?php print $product['os'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
