<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Узел ' . $uz->id;
$this->params['breadcrumbs'][] = $this->title;

$certuzs = $uz->certuz;
?>
<script>
    function customer_description_edit_open(){
        $(".customers_description_show_mode").hide();
        $(".customers_description_edit_mode").show();
        $(".customers_doc_edit_mode").hide();
        $(".customers_doc_show_mode").show();
    }

    function customer_description_edit_cancel() {
        $(".customers_description_edit_mode").hide();
        $(".customers_description_show_mode").show();
    }
    function customer_doc_edit_open(){
        $(".customers_doc_show_mode").hide();
        $(".customers_doc_edit_mode").show();
        $(".customers_description_edit_mode").hide();
        $(".customers_description_show_mode").show();
    }

    function customer_doc_edit_cancel() {
        $(".customers_doc_edit_mode").hide();
        $(".customers_doc_show_mode").show();
    }

</script>
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

<div class="container-fluid col-lg-12">


    <div class="customers_description_show_mode">
        <button type="button" class="btn btn-xs" OnClick="customer_description_edit_open();" title = "Редактировать" id="customer_description_edit_open_button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>



        <p type="text" id="customer_description">
            <?
            if ($uz['description'] == NULL){
                echo ('Примечания отсутствуют.');
            }
            else {
                echo ($uz['description']);
            }
            ?>
        </p>
    </div>
    <div class="form-group customers_description_edit_mode" hidden>
        <?php $form = ActiveForm::begin(['id' => 'description-form']); ?>

        <div class="form-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span>', ['class' => 'btn btn-xs', 'name' => 'customers-description-button', 'title' => 'Сохранить']) ?>
            <button type="button" class="btn btn-xs" OnClick="customer_description_edit_cancel();" title = "Отменить"><span class="glyphicon glyphicon-remove"></span></button>

        </div>
        <p type="text" id="customer_description">
            <?
            if ($uz['description'] == NULL){
                echo ('Примечания отсутствуют.');
            }
            else {
                echo ($uz['description']);
            }
            $text = preg_replace( "#<br />#", "\n", $uz->description );
            $uz->description = $text;
            // при вводе примечания не выводились и знак следующей строки!
            ?>
        </p>
        <?= $form->field($model, 'description')->textarea(['class' => "form-control",
            'style'=>"resize:vertical",
            'value'=>$uz->description
        ]);?>


        <?php ActiveForm::end(); ?>
    </div>
</div>
