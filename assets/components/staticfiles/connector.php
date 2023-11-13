<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var StaticFiles $StaticFiles */
$StaticFiles = $modx->getService('StaticFiles', 'StaticFiles', MODX_CORE_PATH . 'components/staticfiles/model/');
$modx->lexicon->load('staticfiles:default');

// handle request
$corePath = $modx->getOption('staticfiles_core_path', null, $modx->getOption('core_path') . 'components/staticfiles/');
$path = $modx->getOption('processorsPath', $StaticFiles->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);