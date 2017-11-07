<?php
use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/confirm-email', 'token' => $user->email_confirm_token]);
?>

<?= Yii::t('app', 'Hello') ?>. <?= Yii::t('app', 'Thanks for registration!') ?><br /><br />
<?= Yii::t('app', 'Follow the link below to activate your account') ?>:<br />
<?= Html::a(Html::encode($resetLink), $resetLink) ?>
