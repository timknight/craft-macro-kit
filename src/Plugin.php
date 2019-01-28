<?php
namespace timknight\macrokit;

use Craft;
use craft\events\RegisterTemplateRootsEvent;
use craft\web\View;
use yii\base\Event;
use yii\helpers\StringHelper;

/**
 * Macro Kit Plugin
 *
 * @property-read Settings $settings
 * @method Settings getSettings()
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public $hasCpSettings = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Event::on(
            View::class,
            View::EVENT_REGISTER_SITE_TEMPLATE_ROOTS,
            function(RegisterTemplateRootsEvent $event) {
                $event->roots[$this->settings->templatePath] = __DIR__ . '/macros';
            }
        );
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml()
    {
        $privateTemplateTrigger = Craft::$app->config->general->privateTemplateTrigger;

        if (!StringHelper::startsWith($this->settings->templatePath, $privateTemplateTrigger)) {
            $tip = Craft::t('macro-kit', 'Beginning with {trigger} is recommended.', [
                'trigger' => "`{$privateTemplateTrigger}`",
            ]);
        }

        return Craft::$app->view->renderTemplateMacro('_includes/forms', 'textField', [
            [
                'first' => true,
                'name' => 'templatePath',
                'id' => 'template-path',
                'value' => $this->settings->templatePath,
                'label' => Craft::t('macro-kit', 'Template Path'),
                'instructions' => Craft::t('macro-kit', 'The template path that `all.twig` should be accessible by.'),
                'tip' => $tip ?? null,
                'errors' => $this->settings->getErrors('templatePath'),
            ]
        ]);
    }
}
