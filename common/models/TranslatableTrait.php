<?php
namespace common\models;

use Yii;
use common\models\Translation;

trait TranslatableTrait
{
    /**
     * Return translation for the attribute or null if none.
     * Falls back to app language if $lang not provided.
     */
    public function getTranslated($attribute, $lang = null)
    {
        $lang = $lang ?: Yii::$app->language;
        $modelName = static::class; // stores full class name; you can map to short name if preferred

        $value = Translation::findValue($modelName, $this->id, $attribute, $lang);
        if ($value !== null && $value !== '') {
            return $value;
        }

        // Optional fallback sequence: for example, try uz-Latn -> uz-Cyrl -> ru -> en
        // Configure fallbacks per your app. Example below:
        $fallbacks = $this->translationFallbacks($lang);
        foreach ($fallbacks as $fb) {
            if ($fb === $lang) continue;
            $v = Translation::findValue($modelName, $this->id, $attribute, $fb);
            if ($v !== null && $v !== '') return $v;
        }

        return null;
    }

    /**
     * Override to define attribute list that should use translations.
     * return ['name','short_description','text'];
     */
    public function getTranslatableAttributes()
    {
        return [];
    }

    public function getTranslationWidgets()
    {
        return [];
    }


    /**
     * Default fallback chain; override in app config if you need different behavior.
     */
    protected function translationFallbacks($lang)
    {
        // simple fallback chain — tweak to your needs
        return Yii::$app->params['languages'];
    }

    /**
     * Helper to return translated or original attribute.
     */
    public function tOrOrig($attribute, $lang = null)
    {
        $translated = $this->getTranslated($attribute, $lang);
        if ($translated !== null) return $translated;

        // return original attribute value
        return $this->{$attribute} ?? null;
    }

    public function saveTranslations()
    {
        $post = Yii::$app->request->post('Translation', []);
        if (!$post) return;

        $languages = array_keys(Yii::$app->params['availableLanguages']);
        $attrs = $this->getTranslatableAttributes();
        $modelName = static::class;

        foreach ($languages as $lang) {
            if (!isset($post[$lang])) continue;

            foreach ($attrs as $attr) {
                if (!array_key_exists($attr, $post[$lang])) continue;

                $value = $post[$lang][$attr];
                Translation::upsertValue(
                    $modelName,
                    $this->id,
                    $attr,
                    $lang,
                    $value
                );
            }
        }
    }
}
