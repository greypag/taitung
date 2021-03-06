<?php

namespace Aventura\Wprss\FeedToPost;

use Aventura\Wprss\Core;

/**
 * A factory that creates Feed to Post add-ons.
 *
 * @since 1.0
 */
class Factory extends Core\Plugin\AddonFactoryAbstract
{
    protected $_tmpParent;

    /**
     * Creates the actual add-on.
     *
     * @since 1.0
     * @return Addon
     */
    protected function _create($data = array())
    {
        $core = $this->getParent();
        $plugin = new Addon($data, $core);
        $factory = new ComponentFactory($plugin);
        $plugin->setFactory($factory);
        $plugin->hook();

        return $plugin;
    }

    /**
     * Gets the instance of the core plugin
     *
     * @todo When there is a real Core plugin class, return its instance.
     * @since 1.0
     * @return Core\Plugin\PluginInterface
     */
    public function getParent()
    {
        if (is_null($this->_tmpParent)) {
            $this->_tmpParent = $this->_createCoreDummyPlugin();
        }
        return $this->_tmpParent;
    }

    /**
     * Creates a dummy instance of the core plugin.
     *
     * @since 1.0
     * @return Plugin\PluginInterface
     */
    protected function _createCoreDummyPlugin()
    {
        $plugin = new Core\Plugin(WPRSS_FILE_CONSTANT);
        $factory = new Core\ComponentFactory($plugin);
        $plugin->setFactory($factory);
        $plugin->setLogger($factory->createLogger());
        $plugin->setEventManager($factory->createEventManager());
        $plugin->hook();

        return $plugin;
    }
}
