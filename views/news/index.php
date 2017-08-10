<?php

use yii\helpers\Html;
use yii\helpers\Url;

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

    <h1 class="bb-color"><?= Html::encode($new->title); ?></h1>
    <p>
        <?= Html::encode($new->text); ?>
    </p>
    <p><a class="btn btn-outline" href="<?= Url::to(['/news']) . '/' . $new->id ?>">Подробнее</a></p>
</div>

<?php endforeach; ?>