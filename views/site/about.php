<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <a href="<?= \yii\helpers\Url::to(['/newcert/index'])?>" >
        SQL Изменения данных старых cert в newcert
    </a>
    </p>



    <p class = changed-area2>
        <a href="<?= \yii\helpers\Url::to(['/newcert/check'])?>" >
            SQL Изменения данных старых cert uzs в cert_uz
        </a>
    </p>
    <p class = changed-area3>
        <a href="<?= \yii\helpers\Url::to(['/newcert/katya'])?>" >
            Для нужд Кати, вывод заказчиком имеющих узел в 592 сети
        </a>
    </p>
    <p class = changed-area3>
        <a href="<?= \yii\helpers\Url::to(['/newcert/konstantin'])?>" >
            Для нужд Константина, вывод узлов находящийхся в Красноярске
        </a>
    </p>
    <code><?= __FILE__ ?></code>
</div>
