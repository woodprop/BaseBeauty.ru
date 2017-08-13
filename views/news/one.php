<?php

use yii\helpers\Html;
use himiklab\colorbox\Colorbox;
/**
 * Вывод одной новости

 * @var $model \app\models\News
 */


?>

<?= Colorbox::widget([
    'targets' => [
        '.colorbox' => [
            'maxWidth' => 800,
            'maxHeight' => 600,
            'rel' => 'image-in-group',
            'current' => 'Изображение {current} из {total}',
        ],
    ],
    'coreStyle' => 1
]) ?>


<div class="row">
    <article class="col-md-8">
        <h2 class="bb-color"><?= $model->title; ?></h2>
        <p><?= $model->text; ?></p>
    </article>
    <aside class="col-md-4">
        <!-- TODO PICTURES -->
        <?php
            if ($imageList):
            foreach ($imageList as $image):
                $imgPath = '/img/uploads/news/' . $model->id . '/' . $image; //ToDo причесать
        ?>
                <a href="<?= $imgPath; ?>" class="thumbnail col-md-6 colorbox image-in-group" title="<?= $model->title; ?>">
                    <img src="<?= $imgPath; ?>">
                </a>


        <?php endforeach;
        endif;
        ?>

    </aside>

</div>