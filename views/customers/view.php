<?php
$this->title = 'Customer';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
//Лучше тут и индиекса кидать сам обьект, а не тольно её ИД и искать её в action


?>
<div class="col-md-12">
    <div class="col-md-3">
        <div class="single-auto">

            <h3>Fullname: <?php echo $customer['fullname'] ?></h3>
            <h4><span>Shortname: <?php echo $customer['shortname'] ?></span></h4>
            <h4><span>Address: <?php echo $customer['address'] ?></span></h4>
        </div>
    </div>
    <?php for ($i = 0; $i < count($uzs); $i++):?>
        <div class="col-md-12">

            <h3>type_id: <?php echo $uzs[$i]['type_id'] ?></h3>
            <h4><span>net_id: <?php echo $uzs[$i]['net_id'] ?></span></h4>
            <h4><span>support_a: <?php echo $uzs[$i]['support_a'] ?></span></h4>
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
    <?php for ($j = 0; $j < count($cert); $j++):?>
    <div class="col-md-3">


        <h3>num: <?php echo $cert[$j]['id'] ?></h3>
    </div>

    <?php endfor; ?>
</div>
<div class="col-md-12">
    <div class="col-md-3">
    <a href="<?= \yii\helpers\Url::to(['/uz/add','customer_id' => $customer['id']])?>" >
        Add
    </a>
    <div class="form-group">
        <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'customers-add-button']) ?>
        <!--ХЗ КАК РАБОТАЕТ ЭТА ЧЁРТОВА КНОПК!-->
    </div>
    </div>
</div>