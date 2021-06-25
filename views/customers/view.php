<?php
$this->title = 'Customer';
$this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap\ButtonDropdown;
use yii\helpers\Html;

//Лучше тут и индиекса кидать сам обьект, а не тольно её ИД и искать её в action



?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-6">

                            <h3><?php echo $customer['fullname'] ?></h3>

        </div>

        <div class="col-xs-6">

                            <h3> <?php echo $customer['shortname'] ?></h3>

        </div>
    </div>
    <div class="row" >
        <div class="col-xs-12">

                                <h4><span>Address: <?php echo $customer['address'] ?></span></h4>

        </div>
    </div>


    <div class="row" >
        <div class="col-xs-12">

                        <div class="normal_mode_labels">
                            <button class="accordion">Узлов <?php echo count($uzs);?> </button>
                            <div class="panel">
        <?php
        if ($uzs != NULL):?>
            <?php for ($i = 0; $i < count($uzs); $i++):?>
                <div class="col-xs-12">
                    <?php
                    $certuzs = $uzs[$i]->certuz;
                    ?>

                    <h3>type_id: <?php echo $uzs[$i]['type_id'] ?></h3>
                    <h4><span>net_id: <?php echo $uzs[$i]['net_id'] ?></span></h4>
                    <h4><span>support_a: <?php echo $uzs[$i]['support_a'] ?></span></h4>
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
            <?php endfor;
        endif;?>
                       </div>
                   </div>
        </div>
    </div>

    <div class="col-xs-12">

        <?= Html::a('Добавить узел', ['/uz/add', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>

        <?= Html::a('Добавить много узлов', ['/uz/manyadd', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>


        <?= Html::a('Добавить сертификаь', ['/cert/add', 'customer_id' => $customer['id']], ['class'=>'btn btn-primary']) ?>

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

<button class="accordion">Section 2</button>
<div class="panel">
    <p>Lorem ipsum...</p>
</div>

<button class="accordion">Section 3</button>
<div class="panel">
    <p>Lorem ipsum...</p>
</div>





    <div class="container-fluid col-lg-12">

                    <!-------<div class="customers_description_edit_mode" hidden>
                        <button type="button" class="btn btn-xs" OnClick="customer_description_edit_save();" title = "Сохранить"><span class="glyphicon glyphicon-ok"></span></button>
                        <button type="button" class="btn btn-xs" OnClick="customer_description_edit_cancel();" title = "Отменить"><span class="glyphicon glyphicon-remove"></span></button>
                    </div> На будущее мне
                     'view' => function($url, $model)   {
                        return Html::a('<button class="btn btn-success">View &nbsp;<i class="glyphicon glyphicon-eye-open"></i></button>',$url);
                    },
                 'update' => function($url, $model) {
                        return Html::a('<button class="btn btn-primary">Update &nbsp;<i class="glyphicon glyphicon-pencil"></i></button>',$url);
                    },
                 'delete' => function($url, $model) {
                      return Html::a('<button class="btn btn-danger">Delete &nbsp;<i class="glyphicon glyphicon-trash"></i></button>', $url,
                             ['data-confirm' => 'Are you sure you want to delete this item?', 'data-method' =>'POST']
                          );
                    <div class="customers_description_show_mode">
                         <button type="button" class="btn btn-xs" OnClick="customer_description_edit_open();" title = "Редактировать" id="customer_description_edit_open_button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                       -------->
                        <span><?= Html::a('<button class="btn btn-primary">Update &nbsp;<i class="glyphicon glyphicon-pencil"></i></button>',
                                ['/uz/add', 'customer_id' => $customer['id']], ['class'=>'btn btn-xs']) ?>
                       </span>

            
                <div class="customers_description_show_mode">
                    <p type="text" id="customer_description">
                        <?
                        if ($customer['description'] == NULL){
                            echo ('Примечания отсутствуют.');
                        }
                        else {
                            echo ($customer['description']);
                        }
                        ?>
                    </p>
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