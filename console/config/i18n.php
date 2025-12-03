<?php

return [
    'sourcePath' => dirname(__DIR__, 2),
    'languages' => Yii::$app->params['languages'],
    'translator' => 'Yii::t',
    'sort' => true,
    'overwrite' => false,
    'removeUnused' => false,
    'format' => 'db',
    'sourceMessageTable' => 'i18n_source',
    'messageTable' => 'i18n_message',
    'catalog' => 'app',
];
