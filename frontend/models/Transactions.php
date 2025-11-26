<?php

namespace app\models;

use dektrium\user\models\User;
use dvizh\order\Order;
use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property string|null $transaction_id
 * @property string|null $octo_uuid
 * @property int|null $order_id
 * @property int|null $sum
 * @property string|null $currency
 * @property string|null $description
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property string|null signature
 * @property string|null hash_key
 * @property float|null total_sum
 * @property float|null transfer_sum
 * @property float|null refunded_sum
 * @property string|null card_country
 * @property string|null maskedPan
 * @property string|null rrn
 * @property string|null payed_time
 * @property string|null card_type
 * @property string|null is_physical_card
 *
 *
 *
 * @property User $createdBy
 * @property Products $product
 * @property User $updatedBy
 */
class Transactions extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_id', 'octo_uuid', 'order_id', 'sum', 'currency', 'description', 'status', 'refunded_sum', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['order_id', 'sum', 'refunded_sum', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['transaction_id', 'octo_uuid', 'status', 'maskedPan', 'rrn', 'payed_time', 'card_type', 'is_physical_card'], 'string', 'max' => 64],
            [['currency'], 'string', 'max' => 10],
            [['total_sum', 'transfer_sum', 'refunded_sum'], 'number'],
            [['description', 'signature', 'hash_key'], 'string', 'max' => 128],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => \dvizh\order\models\Order::class, 'targetAttribute' => ['order_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_id' => 'Transaction ID',
            'octo_uuid' => 'Octo Uuid',
            'order_id' => 'Product ID',
            'sum' => 'Sum',
            'currency' => 'Currency',
            'description' => 'Description',
            'status' => 'Status',
            'refunded_sum' => 'Refunded Sum',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

}
