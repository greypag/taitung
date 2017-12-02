<?php

class WPRSS_FTP_FeedsApi_Deprecated
{
    const SETTING_KEY_FULL_TEXT_RSS_SERVICE = 'full_text_rss_service';
    const SETTING_VALUE_FEEDS_API = 'feeds_api';

    protected $_hub;
    protected $_settings;

    /**
     * Create a new instance of this class.
     *
     * @since 3.7
     * @param WPRSS_FTP $hub The instance of the main F2P object to use.
     * @param WPRSS_FTP_Settings $settings The instance of the F2P Seetting object to use.
     * @return WPRSS_FTP_FeedsApi_Deprecated The new instance.
     */
    public static function factory(WPRSS_FTP $hub, WPRSS_FTP_Settings $settings)
    {
        return new self($hub, $settings);
    }

    /**
     * @since 3.7
     * @param WPRSS_FTP $hub The instance of the main F2P object to use.
     * @param WPRSS_FTP_Settings $settings The instance of the F2P Seetting object to use.
     */
    public function __construct(WPRSS_FTP $hub, WPRSS_FTP_Settings $settings)
    {
        $this->_setHub($hub);
        $this->_setSettings($settings);
        $this->_construct();
    }

    /**
     * Parameter-less constructor.
     *
     * This is what you probably want to override.
     *
     * @since 3.7
     */
    protected function _construct()
    {
    }

    /**
     * @since 3.7
     * @param WPRSS_FTP $hub The main F2P instance this object will use.
     * @return \WPRSS_FTP_FeedsApi_Deprecated This instance.
     */
    protected function _setHub(WPRSS_FTP $hub)
    {
        $this->_hub = $hub;
        return $this;
    }

    /**
     * @since 3.7
     * @return WPRSS_FTP The main hub class of Feed to Post.
     */
    public function getHub()
    {
        return $this->_hub;
    }

    /**
     * @since 3.7
     * @param WPRSS_FTP_Settings $settings The F2P Settings instance this object will use.
     * @return \WPRSS_FTP_FeedsApi_Deprecated This instance.
     */
    protected function _setSettings(WPRSS_FTP_Settings $settings)
    {
        $this->_settings = $settings;
        return $this;
    }

    /**
     * Get all or one setting.
     *
     * @since 3.7
     * @return WPRSS_FTP_Settings|mixed The Settings instance, if no key specified.
     *  Otherwise, the option value. If option does not exist, presumably `null` and throw a notice :(
     */
    public function getSettings($key = null)
    {
        if (is_null($key)) {
            return $this->_settings;
        }

        if (!$this->_settings) {
            throw new Exception(sprintf('Cannot get setting with key "%1$s": Settings instance not available', $key));
        }

        return $this->_settings->get($key);
    }

    /**
     * Hooks this object in.
     *
     * This is what enables it to work. Must be manually called on an instance.
     *
     * @since 3.7
     * @return \WPRSS_FTP_FeedsApi_Deprecated This instance.
     */
    public function hook()
    {
        add_action('plugins_loaded', array($this, '_onLoaded'));

        return $this;
    }

    /**
     * Handles a `plugins_loaded` action.
     *
     * @since 3.7
     */
    public function _onLoaded()
    {
        if (is_admin()) {
            $this->addNotices();
        }
    }

    /**
     * Adds notices to the backend.
     *
     * @since 3.7
     * @return \WPRSS_FTP_FeedsApi_Deprecated This instance.
     */
    public function addNotices()
    {
        $this->addFeedsApiDeprecationNotice();

        return $this;
    }

    /**
     * Adds the notice about FeedsAPI being deprecated.
     *
     * @since 3.7
     * @return \WPRSS_FTP_FeedsApi_Deprecated This instance.
     */
    public function addFeedsApiDeprecationNotice()
    {
        $this->getNotices()->add_notice(array(
            'id'                => $this->prefix('notice_feedsapi_deprecated'),
            'condition'         => array('func' => array($this, 'canShowFeedsApiDeprecationNotice')),
            'notice_type'       => 'error',
            'content'           => wpautop(sprintf(__('<strong>Support for FeedsAPI will be discontinued</strong> as of the next release of <strong>Feed to Post</strong>. '
                . 'Read more about this and how to migrate <a href="%1$s" target="_blank">here</a>'), 'http://www.wprssaggregator.com/feed-to-post-to-stop-supporting-feedsapi')),
        ));

        return $this;
    }

    /**
     * Determine whether the FeedsAPI deprection notice is allowed to be displayed on the backend.
     *
     * @since 3.7
     * @return bool True if the notice about FeedsAPI being deprecated is allowed to be displayed;
     *  otherwise false.
     */
    public function canShowFeedsApiDeprecationNotice()
    {
        return $this->getHub()->isAdminWpraPage() && $this->isFeedsApiSelected();
    }

    /**
     * Determine whether or not the FeedsAPI option is selected for the Full Text service to use.
     *
     * @since 3.7
     * @return bool True if the administrator has chosen to use the FeedsAPI service;
     *  otherwise false.
     */
    public function isFeedsApiSelected()
    {
        return $this->getSelectedFullTextService() === self::SETTING_VALUE_FEEDS_API;
    }

    /**
     * Get the code of the selected Full Text service.
     *
     * @since 3.7
     * @return string The code representing the service that is selected to be used as the Full Text service.
     */
    public function getSelectedFullTextService()
    {
        return $this->getSettings(self::SETTING_KEY_FULL_TEXT_RSS_SERVICE);
    }

    /**
     * Prefix a string with the F2P prefix.
     *
     * @since 3.7
     * @see WPRSS_FTP::prefix()
     * @param type $string
     * @return The prefixed string
     * @throws Exception If hub class cannot be determined, usually due to an instance not being set.
     */
    public function prefix($string)
    {
        if (!($class = $this->getHubClass())) {
            throw new Exception('Could not prefix: Unable to determine class of the hub object');
        }

        return call_user_func_array(sprintf('%1$s::prefix', $class), array($string));
    }

    /**
     * Get the instance of the main F2P class.
     *
     * @since 3.7
     * @return WPRSS_FTP|null The instance of the main F2P class set for this instance.
     */
    public function getHubClass()
    {
        if (!$this->getHub()) {
            return null;
        }
        return get_class($this->getHub());
    }

    /**
     * Get the notices collection.
     *
     * @since 3.7
     * @return WPRSS_Admin_Notices The object that handles notices for this plugin.
     */
    public function getNotices()
    {
        return $this->getHub()->getNotices();
    }
}

WPRSS_FTP_FeedsApi_Deprecated::factory(WPRSS_FTP::get_instance(), WPRSS_FTP_Settings::get_instance())->hook();
