<?php
namespace timknight\macrokit;

use craft\base\Model;
use yii\validators\InlineValidator;

/**
 * Macro Kit settings
 */
class Settings extends Model
{
    /**
     * @var string The template path that `all.twig` should be accessible by
     */
    public $templatePath = '_macrokit';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['templatePath', 'trim'];
        $rules[] = ['templatePath', 'required'];
        $rules[] = ['templatePath', function($attribute, $params, InlineValidator $validator) {
            $this->templatePath = trim($this->templatePath, '/');
            if (!preg_match('/^[\w\/\-]+$/', $this->templatePath)) {
                $validator->addError($this, $attribute, '{attribute} is not a valid template path.');
            }
        }];

        return $rules;
    }
}
