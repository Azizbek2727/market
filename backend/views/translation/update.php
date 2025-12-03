<?php

use yii\helpers\Html;

/** @var $model common\models\SourceMessage */
/** @var $languages array */

$this->title = "Edit: {$model->message}";
?>

<h3><?= Html::encode($this->title) ?></h3>

<div class="card p-4">

    <?= Html::beginForm() ?>

    <p><strong>Category:</strong> <?= $model->category ?></p>
    <p><strong>Source message:</strong></p>
    <div class="alert alert-secondary"><?= nl2br(Html::encode($model->message)) ?></div>

    <?php foreach ($languages as $lang => $label): ?>
        <div class="mb-3">
            <label class="form-label"><?= $label ?> (<?= $lang ?>)</label>
            <textarea class="form-control" rows="3"
                      name="translation[<?= $lang ?>]"><?=
                Html::encode($model->getTranslation($lang)) ?></textarea>
        </div>
    <?php endforeach; ?>

    <button class="btn btn-success">Save</button>

    <?= Html::endForm() ?>

</div>
