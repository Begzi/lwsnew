<?php
$this->title = 'Customer';
$this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap\ButtonDropdown;
use yii\helpers\Html;
use app\models\CastomersForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

//Лучше тут и индиекса кидать сам обьект, а не тольно её ИД и искать её в action



?>
<script>
    function customer_description_edit_open(){
        $(".customers_description_show_mode").hide();
        $(".customers_description_edit_mode").show();
    }

    function customer_description_edit_cancel() {
        $(".customers_description_edit_mode").hide();
        $(".customers_description_show_mode").show();
    }
    function customer_description_edit_save(){
        var tmp = document.getElementById("customer_description_edit_box").value();

        $(".customers_description_edit_mode").hide();
        $(".customers_description_show_mode").show();
    }

</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8">
            <div class="col-xs-12">

                                <h3><?php echo $customer['fullname'] ?></h3>

            </div>

            <div class="col-xs-12">

                                <h4> <?php echo $customer['shortname'] ?></h4>

            </div>

        </div>
        <div class="col-xs-4">
            <div class="col-xs-12">
                <?= Html::a('Журнал обращений', ['/ticket/index', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>
                <?= Html::a('Создать обращение', ['/uz/add', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>

            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <?= Html::a('Схема сети учреждения', ['/uz/add', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>

            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-xs-12">
            <div class="col-xs-12">

                                <h4><span>Юридический адресс: <?php echo $customer['address'] ?></span></h4>

            </div>
            <div class="col-xs-12">
                                <h4><span>ИНН: <?php echo $customer['UHH'] ?></span></h4>

            </div>
            <div class="col-xs-12">
                                    <h4><span>Тип обмена документами: <?php echo $customer->doctype->name ?></span></h4>

            </div>
        </div>
    </div>

    <div class="col-xs-12">

        <?= Html::a('Добавить узел', ['/uz/add', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>

        <?= Html::a('Добавить много узлов', ['/uz/manyadd', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>


        <?= Html::a('Добавить сертификат', ['/cert/add', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>

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

    </div>
<?php if ($realuzs != NULL):?>
<?php for ($k = 0; $k < count($realuzs); $k++):?>
    <div class="row" >
        <div class="col-xs-12">

                        <div class="normal_mode_labels">
                            <button class="accordion">Узлов <?php echo count($realuzs[$k]) .' '.
                                    $realuzs[$k][0]->uztype->name;?> </button>
                            <div class="panel">

            <?php for ($i = 0; $i < count($realuzs[$k]); $i++):?>
                <div class="col-xs-12">
                    <?php
                    $certuzs = $realuzs[$k][$i]->certuz;
                    ?>

                    <h3>type_id: <?php echo $realuzs[$k][$i]->uztype->name ?></h3>
                    <h4><span>net_id: <?php echo $realuzs[$k][$i]->uznet->num ?></span></h4>
                    <h4><span>support_a: <?php echo $realuzs[$k][$i]['support_a'] ?></span></h4>
                    <?php
                    for ($j = 0; $j < count($certuzs); $j++):?>
                        <?php
                        $cert = $certuzs[$j]->cert;
                        echo $certuzs;
                        ?>

                        <span>cert id <?php echo $cert['id']; ?></span>
                        <span>cert date <?php echo $cert['ex_date']; ?></span>
                        <span>cert id <?php echo $cert['num']; ?></span>
                        <p></p>

                    <?php endfor; ?>
                </div>
            <?php endfor;?>
                       </div>
                   </div>
        </div>
    </div>

<?php endfor;
endif;?>




    <div class="container-fluid col-lg-12">


        <div class="customers_description_show_mode">
                        <button type="button" class="btn btn-xs" OnClick="customer_description_edit_open();" title = "Редактировать" id="customer_description_edit_open_button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>



                        <label type="text" id="customer_description">
                            <?
                            if ($customer['description'] == NULL){
                                echo ('Примечания отсутствуют.');
                            }
                            else {
                                echo ($customer['description']);
                            }
                            ?>
                        </label>
        </div>
        <div class="form-group customers_description_edit_mode" hidden>
            <form method="get" action="<?= Url::to(['customers/description']) ?>">
                <div class="form-group">
                    <button type="button" class="btn btn-xs" OnClick="customer_description_edit_save();" title = "Сохранить"><span class="glyphicon glyphicon-ok"></span></button>
                    <button type="button" class="btn btn-xs" OnClick="customer_description_edit_cancel();" title = "Отменить"><span class="glyphicon glyphicon-remove"></span></button>
                </div>

                <textarea type="text" class="form-control" style="resize:vertical" id="customer_description_edit_box" name="customer_description_edit_box"><? echo $customer['description']; ?></textarea>
            </form>
        </div>
    </div>
</div>


<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>



<!--<--------------'view' => function($url, $model)   {
                        return Html::a('<button class="btn btn-success">View &nbsp;<i class="glyphicon glyphicon-eye-open"></i></button>',$url);
                    },
                 'update' => function($url, $model) {
                        return Html::a('<button class="btn btn-primary">Update &nbsp;<i class="glyphicon glyphicon-pencil"></i></button>',$url);
                    },
                 'delete' => function($url, $model) {
                      return Html::a('<button class="btn btn-danger">Delete &nbsp;<i class="glyphicon glyphicon-trash"></i></button>', $url,
                             ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' =>'POST']
                          ); кнопки красивые ТУТЬ!

                           <span>
                        </span>----->