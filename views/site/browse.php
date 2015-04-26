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
                        print "<a href=" . Url::to(['product', 'id' => $id]) . " class='list-group-item'>" .
                            "<h4 class='list-group-item-heading'>" . $product['name'] ."</h4></a>";
                    endforeach;
                ?>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Filters</div>
                <div class="panel-body">
                    <h4>Operating Systems</h4>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            Windows
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            OSX
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            Linux
                        </label>
                    </div>

                    <br><h4>Rating</h4>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            5
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            4
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            3
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            2
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" checked>
                            1
                        </label>
                    </div>

                    <br><button type="button" class="btn btn-primary pull-right">Filter</button>
                </div>
            </div>
        </div>
    </div>
</div>
