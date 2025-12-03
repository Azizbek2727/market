<?php

namespace common\models;

use Yii;
use common\models\TranslatableTrait;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $url
 * @property string $short_test
 * @property int $sort
 */
class Slider extends \yii\db\ActiveRecord
{
    use TranslatableTrait;

    public function getTranslatableAttributes()
    {
        return [
            'name',
            'short_text',
        ];
    }

    public function getTranslationWidgets()
    {
        return [
            'name' => 'input',        // simple text input
            'short_text' => 'imperavi',
        ];
    }

    function behaviors()
    {
        return [
            'images' => [
                'class' => 'dvizh\gallery\behaviors\AttachImages',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort'], 'integer'],
            [['url', 'short_text', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'url' => 'Ссылка',
            'short_text' => 'Краткое описание',
            'sort' => 'Порядок',
        ];
    }

    // convenience getters used by views (so $product->name works unchanged)
    public function getName()
    {
        return $this->tOrOrig('name');
    }

    // convenience getters used by views (so $product->name works unchanged)
    public function getShort_text()
    {
        return $this->tOrOrig('short_text');
    }
}
