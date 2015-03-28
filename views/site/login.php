<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $loginmodel app\models\LoginForm */

$this->title = 'Login/Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n{input}\n{error}",
                                'labelOptions' => ['class' => 'control-label'],
                            ],
                        ]); ?>

                        <?= $form->field($loginmodel, 'username') ?>

                        <?= $form->field($loginmodel, 'password')->passwordInput() ?>
                        <div class="col-md-6">
                            <?= $form->field($loginmodel, 'rememberMe', [
                                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            ])->checkbox() ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign Up</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n{input}\n{error}",
                                'labelOptions' => ['class' => 'control-label'],
                            ],
                        ]); ?>

                        <?= $form->field($signupmodel, 'username') ?>

                        <?= $form->field($signupmodel, 'password')->passwordInput() ?>

                        <?= $form->field($signupmodel, 'confirm_password')->passwordInput() ?>

                            <div class="form-group">
                                <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
