<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var $dataProvider yii\data\ActiveDataProvider */
/** @var $languages array */

$this->title = 'Message Translations';

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="card p-3 mb-4">
    <?= Html::beginForm(['index'], 'get') ?>
    <div class="input-group">
        <input type="text" name="q" value="<?= $searchModel->q ?>" class="form-control"
               placeholder="Search messages...">
        <button class="btn btn-primary">Search</button>
    </div>
    <?= Html::endForm() ?>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [

        'category',
        'message:ntext',

        // Show translations for each language
        [
            'label' => 'Translations',
            'format' => 'raw',
            'value' => function ($model) use ($languages) {
                $html = '<div style="font-size: 12px;">';
                foreach ($languages as $lang => $label) {
                    $html .= "<strong>{$label}</strong>: " .
                        Html::encode($model->getTranslation($lang)) . "<br>";
                }
                return $html . "</div>";
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
        ]
    ],
]) ?>
