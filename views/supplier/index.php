<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use \yii\grid\CheckboxColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<form id="supplier-form" method="post" action="/index.php?r=supplier/export">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

    <div class="supplier-index">

        <input type="hidden" class="form-control" id="checkAll-input" name="isCheckAll" value="0" >

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Supplier', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Export Supplier', "javascript:void(0);", ['class' => 'btn btn-primary export-btn']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options'   => [
                    "id" => "supplier-grid"
            ],
            'columns' => [
                [
                        'class' => CheckboxColumn::class,
                        "name" => "selectIds",
                ],

                'id',
                'name',
                'code',
                [
                    'attribute' => 't_status',
                    'filter'    => ['all' => 'all', 'ok' => 'ok', 'hold' => 'hold']
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, \app\models\Supplier $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                     },
                ],
            ],
        ]); ?>


    </div>
</form>

<!-- checkAll Modal -->
<div class="modal fade" id="checkAll-Modal" tabindex="-1" aria-labelledby="checkAllModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkAllModalLabel">check tip!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                All 10 conversations on this page have been selected.Do you want to select all conversations that match this search?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="checkAll-no">No</button>
                <button type="button" class="btn btn-primary" id="checkAll-yes">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- checkSelect Modal -->
<div class="modal fade" id="checkSelect-Modal" tabindex="-1" aria-labelledby="checkSelectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkSelectModalLabel">check tip!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                All conversations in this search have been selected.Do you want to clear selection?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="checkSelect-no" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="checkSelect-yes">Yes</button>
            </div>
        </div>
    </div>
</div>