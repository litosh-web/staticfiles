<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/StaticFiles/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/staticfiles')) {
            $cache->deleteTree(
                $dev . 'assets/components/staticfiles/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/staticfiles/', $dev . 'assets/components/staticfiles');
        }
        if (!is_link($dev . 'core/components/staticfiles')) {
            $cache->deleteTree(
                $dev . 'core/components/staticfiles/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/staticfiles/', $dev . 'core/components/staticfiles');
        }
    }
}

return true;