<?php

use yii\helpers\Html;
/**
 * Вывод одной новости

 * @var $model \app\models\News
 */


?>
<div class="row">
    <article class="col-md-8">
        <h2><?= $model->title; ?></h2>
        <p><?= $model->text; ?></p>
    </article>
    <aside class="col-md-4">
        <!-- TODO PICTURES -->
        <?php
            foreach ($imageList as $image):
                $imgPath = '/img/uploads/news/' . $model->id . '/' . $image; //ToDo причесать
        ?>
                <a href="#" class="thumbnail">
                    <img src="<?= $imgPath; ?>">
                </a>


        <?php endforeach; ?>

    </aside>

</div>