<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Message;

class SourceMessage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%i18n_source}}';
    }

    public function getMessages()
    {
        return $this->hasMany(Message::class, ['id' => 'id'])
            ->indexBy('language');
    }

    public function getTranslation($lang)
    {
        return $this->messages[$lang]->translation ?? '';
    }

    public function setTranslation($lang, $value)
    {
        $msg = $this->messages[$lang] ?? new Message([
                'id' => $this->id,
                'language' => $lang
            ]);

        $msg->translation = $value;
        $msg->save(false);
    }
}
