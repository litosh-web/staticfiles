<?php

/**
 * The home manager controller for StaticFiles.
 *
 */
class StaticFilesHomeManagerController extends modExtraManagerController
{
    /** @var StaticFiles $StaticFiles */
    public $StaticFiles;


    /**
     *
     */
    public function initialize()
    {
        $this->StaticFiles = $this->modx->getService('StaticFiles', 'StaticFiles', MODX_CORE_PATH . 'components/staticfiles/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['staticfiles:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('staticfiles');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->StaticFiles->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->StaticFiles->config['jsUrl'] . 'mgr/staticfiles.js');
        $this->addJavascript($this->StaticFiles->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->StaticFiles->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->StaticFiles->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->StaticFiles->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->StaticFiles->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->StaticFiles->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        StaticFiles.config = ' . json_encode($this->StaticFiles->config) . ';
        StaticFiles.config.connector_url = "' . $this->StaticFiles->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "staticfiles-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="staticfiles-panel-home-div"></div>';

        return '';
    }
}