<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\helpers\Url;
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

<section class="customers-area">
    <div class="container">
            <div class="col-md-4">
                <section class="box search">
                    <form method="get" action="<?= Url::to(['customers/searchfull']) ?>">
                        <input type="text" class="text" name="search" placeholder="Поиск по полному названию" />
                        <?php  if ($searchfull != NULL):?>
                            <label type="text" class="text"><?php echo $searchfull;?></label>
                            <?= Html::a('<span class="glyphicon glyphicon-remove" style="color:black"></span>', ['customers/searchfull','search'=> ''], ['class'=>'btn btn-xs', 'name' => 'customers-search-button', 'title' => 'Cancel']) ?>

                        <?php endif;?>
                    </form>
                </section>
            </div>


        <div class="col-md-12 col-md-offset-12">

            <a href="<?= \yii\helpers\Url::to(['/customers/add'])?>" >
                Add
            </a>

            <?= Html::a('Добавить заказчика', ['/customers/add'], ['class'=>'btn btn-primary']) ?>

        </div>

        <div class="col-xs-12 col-md-8">
                <span class="inline-1">Полное наименование учреждения</span>
        </div>

        <div class="col-xs-6 col-md-4">
                <span class="inline-2">Краткое наименование учреждения</span>

    <!--        </div>-->
        </div>
    <!--        <div class="col-md-12">-->
    <?php for ($i = 0; $i < count($customers); $i++):?>
        <div class="col-xs-12 col-md-8">
             <div class="single-customer-fullname">

                  <h4>
                      <a href="<?= \yii\helpers\Url::to(['/customers/view','id' => $customers[$i]['id']])?>">
                          <span >
                              <?php echo $customers[$i]['fullname'] ?>
                          </span>
                      </a>
                  </h4>

             </div>
        </div>
        <div class="col-xs-12 col-md-4">
             <div class="single-customer-shortname">
                 <h4>
                     <p>
                         <span>
                             <?php echo $customers[$i]['shortname'] ?>
                         </span>
                     </p>
                 </h4>
             </div>
        </div>
    <?php endfor; ?>
<!--        </div>-->
        <div class="pegination">
            <div class="nav-links">
                <?php echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ])?>
            </div>
        </div>
    </div>
</section>
<br>