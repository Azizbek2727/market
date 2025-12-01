<?php
namespace common\models;

use yii\db\ActiveRecord;

class Translation extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%translation}}';
    }

    public static function findValue($modelName, $itemId, $attribute, $lang)
    {
        return static::find()
            ->select('value')
            ->where([
                'modelName' => $modelName,
                'itemId'    => $itemId,
                'attribute' => $attribute,
                'lang'      => $lang,
            ])
            ->scalar();
    }

    public static function upsertValue($modelName, $itemId, $attribute, $lang, $value)
    {
        $t = static::findOne([
            'modelName' => $modelName,
            'itemId'    => $itemId,
            'attribute' => $attribute,
            'lang'      => $lang,
        ]);

        if (!$t) {
            $t = new static([
                'modelName' => $modelName,
                'itemId'    => $itemId,
                'attribute' => $attribute,
                'lang'      => $lang,
            ]);
        }

        $t->value = $value;
        return $t->save(false);
    }
}
