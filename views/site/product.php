<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $product['name'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

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

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Reviews</h3>
                </div>
                    <ul class="list-group">
                    <?php if (count($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <li class="list-group-item">
                                <h4 class="list-group-item-heading">User: <?= $review['username'] ?>
                                    <span class="pull-right"><small> <?= $review['rating'] ?>/5 stars</small></span></h4>
                                <p class="list-group-item-text"><?= $review['comment'] ?></p>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="panel-body">No Reviews</div>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Leave a Review</h3>
                </div>
                <div class="panel-body">
                    <?php if(!Yii::$app->user->isGuest): ?>
                    <form action="addreview" method="POST">
                        <input type="hidden" name="prodId" value="<?php print (string)$product['_id'] ?>">
                        <h4>Rating</h4>

                        <div class="radio">
                            <label>
                                <input type="radio" name="rating" id="optionsRadios5" value="5" checked>
                                5
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="rating" id="optionsRadios4" value="4">
                                4
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="rating" id="optionsRadios3" value="3">
                                3
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="rating" id="optionsRadios2" value="2">
                                2
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="rating" id="optionsRadios1" value="1">
                                1
                            </label>
                        </div>
                        <h4>Comment</h4>
                        <textarea name="comment" class="form-control" rows="5"></textarea><br>
                        <button type="submit" class="btn btn-primary form-control">Save</button>
                    </form>
                    <?php else: ?>
                        <p>Please login to leave a review.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


</div>
