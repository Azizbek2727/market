<?php

namespace common\models;

use yii\db\ActiveRecord;

class OfflineSale extends ActiveRecord
{
    public static function tableName()
    {
        return 'offline_sale';
    }

    public function rules()
    {
        return [
            [['telegram_user_id', 'product_id', 'price'], 'required'],
            [['telegram_user_id', 'product_id', 'quantity', 'created_at'], 'integer'],
            [['price'], 'number'],
            [['currency'], 'string', 'max' => 3],
        ];
    }
}
