<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$email = 'mail@basebeauty.ru';
$tel1 = '+7 (495) 710-7298';
$tel2 = '+7 (903) 562-5952';
$tel3 = '+7 (903) 764-3886';
?>
<div class="site-contact">
    <div class="row contact-content">
        <h1 class="bb-color">Наши контакты</h1>
        <img src="../../img/contact-title.png" alt="">

        <div class="contact-data">
            <h3 class="bb-color">Email:</h3>
            <a href="mailto:<?= $email; ?>"><?= $email; ?></a>
            <h3 class="bb-color">Тел./Факс:</h3>
            <a href="tel:<?= $tel1; ?>"><?= $tel1; ?></a>
            <br>
            <a href="tel:<?= $tel2; ?>"><?= $tel2; ?></a>
            <br>
            <a href="tel:<?= $tel3; ?>"><?= $tel3; ?></a>
        </div>
    </div>
</div>
