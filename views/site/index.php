<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Open Reviews';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Open Reviews</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Top Rated</div>
                    <?php if (count($prods)): ?>
                        <?php foreach ($prods as $product): ?>
                            <a class="list-group-item" href="<?php print Url::to(['product', 'id' => (string)$product['_id']]) ?>">
                                <h4 class="list-group-item-heading"><?= $product['name'] ?>
                                    <span class="pull-right"><small> <?= $product['avgRating'] ?>/5 stars</small></span></h4>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="panel-body">No Comparison Available</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Most Recent Reviews</div>
                    <ul class="list-group">
                        <?php if (count($reviews)): ?>
                            <?php foreach ($reviews as $review): ?>
                                <a class="list-group-item" href="<?php print Url::to(['product', 'id' => (string)$review['prodId']]) ?>">
                                    <h4 class="list-group-item-heading">User: <?= $review['username'] ?>
                                        <span class="pull-right"><small> <?= $review['rating'] ?>/5 stars</small></span></h4>
                                    <p class="list-group-item-text"><?= $review['comment'] ?></p>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="panel-body">No Reviews</div>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
