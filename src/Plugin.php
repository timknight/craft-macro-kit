<?php
namespace timknight\macrokit;

use craft\events\RegisterTemplateRootsEvent;
use craft\web\View;
use yii\base\Event;

/**
 * Macro Kit Plugin
 */
class Plugin extends \craft\base\Plugin
{
    public function init()
    {
        parent::init();

        Event::on(
            View::class,
            View::EVENT_REGISTER_SITE_TEMPLATE_ROOTS,
            function(RegisterTemplateRootsEvent $event) {
                $event->roots['macrokit'] = __DIR__ . '/macros';
            }
        );
    }
}
