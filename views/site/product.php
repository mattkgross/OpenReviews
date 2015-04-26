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

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Leave a Review</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-4">
                    <h4>Rating</h4>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="star5" checked>
                            5
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="star4" checked>
                            4
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios3" value="star3" checked>
                            3
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="star2" checked>
                            2
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="star1" checked>
                            1
                        </label>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4>Comment</h4>
                    <textarea class="form-control" rows="5"></textarea>
                </div>
            </div>

            <div class="row"></div>
            <button class="btn btn-primary pull-right">Save</button>
            </div>
        </div>
    </div>
</div>
