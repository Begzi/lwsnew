<?php

/* @var $this yii\web\View */


$this->title = 'Customers';


use yii\helpers\Html;
use yii\web\View;

?>
<br>
<br>
<br>
<?php

$uzs = array();
$check1='Красноярск,';
$check2='Красноярск ';
$check3='Красноярск.';
for ($i=0; $i < count($customer); $i++){

    $pos1 = strripos($customer[$i]->address, $check1);
    $pos2 = strripos($customer[$i]->address, $check2);
    $pos3 = strripos($customer[$i]->address, $check3);

    if ($pos1 === FALSE or $pos2 === FALSE or $pos3 === FALSE ){

        $uzs = array_merge($uzs, $customer[$i]->uzs);

    }

}
$k = 0;
for ($j = 1; $j < 18; $j++){
    for ($i=0; $i < count($uzs); $i++) {
        if ($uzs[$i]->type_id == $j){
            $k = $k + 1;
        }
        if ($k == 1 and $uzs[$i]->type_id == $j){
            echo $uzs[$i]->uztype[0]->name;
        }
    }
    echo " Всего: ";
    echo $k;
    echo '<br>';
    $k = 0;
}

?>
<br>
<?php
echo count($uzs);
?>


<section class="auto-post-area">
    <div class="conteiner"">
    <div class="col-md-12">

    </div>
    <div class="col-md-12">
        <!--        <div class="" float="left">-->
        <span class="inline-1">Полное наименование учреждения</span>
        <!--        </div>-->
        <!--        <div class="" float="right" >-->
        <span class="inline-2">Краткое наименование учреждения</span>
        <h3><span class="inline-2">Всего узлов: </span><?php
            echo count($uzs);
            ?>
        </h3>
        <!--        </div>-->
    </div>
    <!--        <div class="col-md-12">-->
    <?php for ($i = 0; $i < count($uzs); $i++):?>
        <div class="col-md-12">
            <div class="single-customer">

                <h3><a href="<?= \yii\helpers\Url::to(['/customers/view','id' => $uzs[$i]->customers['id']])?>"><?php echo $uzs[$i]->customers['fullname'] ?></a></h3>

                <h3><p> <?php echo $uzs[$i]->customers['shortname'] ?></p></h3>

                <h3><p> <?php echo $uzs[$i]->uztype[0]->name ?></p></h3>
            </div>
        </div>
    <?php endfor; ?>
    <!--        </div>-->
    </div>
</section>
<section class="customers-area">


</section>
