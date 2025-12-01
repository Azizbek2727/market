<?php
/** @var $model \yii\db\ActiveRecord */
/** @var $lang string */

$attrs = $model->getTranslatableAttributes();

foreach ($attrs as $attr): ?>
    <div class="form-group">
        <label><?= $model->getAttributeLabel($attr) ?></label>

        <?= \yii\helpers\Html::textarea(
            "Translation[{$lang}][{$attr}]",
            \common\models\Translation::findValue(get_class($model), $model->id, $attr, $lang),
            ['class' => 'form-control']
        ) ?>
    </div>
<?php endforeach; ?>
