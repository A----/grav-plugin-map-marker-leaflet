<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class MapMarkerLeafletPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        //add assets
        $assets = $this->grav['assets'];

        $assets->registerCollection('leaflet', [
            'plugin://map-marker-leaflet/assets/leaflet.js',
            'plugin://map-marker-leaflet/assets/leaflet.css'
        ]);

        //$assets->add('leaflet', 90);

        // Enable the main events we are interested in
        $this->enable([
            'onAssetsInitialized' => ['onAssetsInitialized', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths',0]
        ]);
    }

    public function onAssetsInitialized()
    {
        $assets = $this->grav['assets'];

        $assets->registerCollection('leaflet', [
            'plugin://map-marker-leaflet/assets/leaflet.js',
            'plugin://map-marker-leaflet/assets/leaflet.css'
        ]);
    }

    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onShortcodeHandlers(Event $e)
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }
}
