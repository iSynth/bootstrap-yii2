<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= ($this->title ? Html::encode($this->title . ' / ') : '') . Yii::$app->name ?></title>
  <?= Html::csrfMetaTags()?>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
  <div id="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/signup']];
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/login']];
    } else {
        $menuItems[] = [
            'label' => Yii::t('app', 'Logout'),
            'url' => ['/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">
      <?= app\widgets\Alert::widget(['template' => '/shared/alert']) ?>
      <?= $content ?>
    </div>
  </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
