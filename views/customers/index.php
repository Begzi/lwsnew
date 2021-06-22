<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\web\View;
$this->title = 'Customers';

for ($i = 0; $i < count($customers); $i++)
{
    if ($customers[$i]['id'] == '126')
    {

        echo $customers[$i]['id'];
        echo " ";
        echo $customers[$i]['fullname'];
        echo " ";
        echo $customers[$i]['shortname'];
        echo " ";
        echo $customers[$i]['address'];
        echo " ";
        echo $customers[$i]['uz_list_id'];
        echo " ";
        echo $customers[$i]['com_id'];
        echo " ";
        echo $customers[$i]['description'];
        echo " ";

    }

}
 ?>


<section class="auto-post-area">
    <div class="conteiner"">
    <div class="col-md-12">

        <a href="<?= \yii\helpers\Url::to(['/customers/add'])?>" >
            Add
        </a>
        <div class="form-group">
            <?= Html::submitButton('Add btn', ['class' => 'btn btn-primary', 'name' => 'customers-add-button']) ?>
            <!--ХЗ КАК РАБОТАЕТ ЭТА ЧЁРТОВА КНОПК!-->
        </div>
    </div>
    <div class="col-md-12">
<!--        <div class="" float="left">-->
            <span class="inline-1">Полное наименование учреждения</span>
<!--        </div>-->
<!--        <div class="" float="right" >-->
            <span class="inline-2">Краткое наименование учреждения</span>

<!--        </div>-->
    </div>
<!--        <div class="col-md-12">-->
            <?php for ($i = 0; $i < count($customers); $i++):?>
            <div class="col-md-12">
               <div class="single-customer">

                    <h3><a href="<?= \yii\helpers\Url::to(['/customers/view','id' => $customers[$i]['id']])?>"><?php echo $customers[$i]['fullname'] ?></a></h3>

                    <h3><p> <?php echo $customers[$i]['shortname'] ?></p></h3>
                </div>
            </div>
            <?php endfor; ?>
<!--        </div>-->
    </div>
</section>
<section class="customers-area">

    <div class="pegination">
        <div class="nav-links">
            <?php echo \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ])?>
        </div>
    </div>
</section>
<br>