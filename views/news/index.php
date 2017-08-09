<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Новости';

if (! Yii::$app->user->isGuest):
    ?>
    <p>
        <?= Html::a('Управление', ['admin'], ['class' => 'btn btn-danger']) ?>
    </p>

<?php endif;

foreach ($news as $new):
?>
<div class="row">

    <h1><?= Html::encode($new->title); ?></h1>
    <p>
        <?= Html::encode($new->text); ?>
    </p>
</div>

<?php endforeach; ?>