<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Welcome!');
?>
<?php $form = ActiveForm::begin([
      'id' => 'login-form',
      'options' => ['class' => Yii::$app->request->isPost ? 'form-signin' : 'form-signin animated fadeIn'],
      'fieldConfig' => [
          'template' => "{label}{input}{error}",
      ]
]); ?>

  <p class="lead"><?= Yii::t('app', 'Control Panel') ?></p>
  <hr>

  <?= $form->field($model, 'email')->textInput([
      'placeholder' => Yii::t('app', 'Enter email'),
      'autofocus' => 'autofocus',
  ]) ?>
  <?= $form->field($model, 'password')->passwordInput([
      'placeholder' => Yii::t('app', 'Enter password')
  ]) ?>
  <?= $form->field($model, 'rememberMe')->checkbox() ?>

  <hr>
  <div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Sign in'), ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
  </div>

<?php ActiveForm::end(); ?>
