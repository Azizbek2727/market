<?php
/** @var $model \yii\db\ActiveRecord */

use common\models\Translation;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

$attrs   = $model->getTranslatableAttributes();
$widgets = method_exists($model, 'getTranslationWidgets')
    ? $model->getTranslationWidgets()
    : [];
foreach ($attrs as $attr):

    $widget = $widgets[$attr] ?? 'textarea';
    $value  = \common\models\Translation::findValue(get_class($model), $model->id, $attr, $lang);

    echo "<div class='form-group'>";
    echo "<label>" . Html::encode($model->getAttributeLabel($attr)) . "</label>";

    switch ($widget) {

        case 'input':
            echo Html::textInput("Translation[{$lang}][{$attr}]", $value, [
                'class' => 'form-control'
            ]);
            break;

        case 'imperavi':
            echo \vova07\imperavi\Widget::widget([
                'name'  => "Translation[{$lang}][{$attr}]",
                'value' => $value,
                'settings' => [
                    'minHeight' => 200,
                    'plugins'   => ['fullscreen', 'fontcolor', 'video'],
                ],
//                'plugins' => ['fullscreen', 'fontcolor', 'video'],
                'options'=>[
                    'minHeight' => 400,
                    'maxHeight' => 400,
                    'buttonSource' => true,
                    'imageUpload' => Url::toRoute(['tools/upload-imperavi'])
                ],
            ]);
            break;

        case 'ckeditor':
            echo \dosamigos\ckeditor\CKEditor::widget([
                'name'  => "Translation[{$lang}][{$attr}]",
                'value' => $value,
            ]);
            break;

        default:
        case 'textarea':
            echo Html::textarea("Translation[{$lang}][{$attr}]", $value, [
                'class' => 'form-control',
                'rows' => 4
            ]);
            break;
    }

    echo "</div>";

endforeach;


?>