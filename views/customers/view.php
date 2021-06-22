<?php
$this->title = 'Customer';
$this->params['breadcrumbs'][] = $this->title;

use app\helpers\TextHelper;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

//Лучше тут и индиекса кидать сам обьект, а не тольно её ИД и искать её в action


echo "asdasdasdasdasa";

?>
<div class="col-md-12">
    <div class="col-md-3">
        <div class="single-auto">

            <h3>id: <?php echo $customer['id'] ?></h3>
            <h3>Fullname: <?php echo $customer['fullname'] ?></h3>
            <h4><span>Shortname: <?php echo $customer['shortname'] ?></span></h4>
            <h4><span>Address: <?php echo $customer['address'] ?></span></h4>
        </div>
    </div>
    <?php for ($i = 0; $i < count($uzs); $i++):?>
        <div class="col-md-12">
            <?php
            $certuzs = $uzs[$i]->certuz;
            echo $certuzs;
            ?>

            <h3>type_id: <?php echo $uzs[$i]['type_id'] ?></h3>
            <h4><span>net_id: <?php echo $uzs[$i]['net_id'] ?></span></h4>
            <h4><span>support_a: <?php echo $uzs[$i]['support_a'] ?></span></h4>
            <?php
            for ($j = 0; $j < count($certuzs); $j++):?>
                <?php
                $newcert = $certuzs[$j]->newcert;
                echo $certuzs;
                ?>

                <span>cert id <?php echo $newcert['id']; ?></span>
                <span>cert date <?php echo $newcert['ex_date']; ?></span>
                <span>cert id <?php echo $newcert['num']; ?></span>
                <p></p>

            <?php endfor; ?>
        </div>
    <?php endfor; ?>

    <?php
//    if (Yii::$customer->session->hasFlash('contactFormSubmitted')): ?>
<!--        <a href="--><?//= \yii\helpers\Url::to(['/auto/delete','id' => $customer['id']])?><!--" >-->
<!--            Delete this auto-->
<!--        </a>-->
<!---->
<!---->
<!--    --><?php //endif; ?>

</div>
<div class="col-md-12">
    <div class="col-md-3">
    <a href="<?= \yii\helpers\Url::to(['/uz/add','customer_id' => $customer['id']])?>" >
        Добавления узла
    </a>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Не рабочая кнопка', ['class' => 'btn btn-primary', 'name' => 'customers-add-button']) ?>
        <!--ХЗ КАК РАБОТАЕТ ЭТА ЧЁРТОВА КНОПК!-->
    </div>
    <?= Html::a('label', ['/uz/add', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>
    <?= Html::button('Press me!', ArrayHelper::merge(['value'=>Url::to(['/uz/add'])], ['additionalOptions'])); ?>
<?php

    echo ButtonDropdown::widget([
    'label' => 'Action',
    'dropdown' => [
    'items' => [
    ['label' => 'DropdownA', 'url' => '/'],
    ['label' => 'DropdownB', 'url' => '#'],
    ],
    ],
    ]);
?>
    <a href="#" class="btn btn--sm  modal-trigger type--uppercase btn-transparent block" data-modal-id="header_callback"><span class="btn__text">Обратный звонок</span></a>

</div>