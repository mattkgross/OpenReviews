<?php
use yii\helpers\Html;
use yii\helpers\Url;

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
                <ul class="list-group">
                <?php
                    foreach($products as $product):
                        $id = (string)$product['_id'];
                        print "<a href=" . Url::to(['product', 'id' => $id]) . " class='list-group-item'>" . $product['name'] . "</a>";
                    endforeach;
                ?>
                </ul>
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
