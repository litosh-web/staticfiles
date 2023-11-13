<?php

$eventName = $modx->event->name;

$sf = $modx->getService('staticfiles' ,'StaticFiles', MODX_CORE_PATH . 'components/staticfiles/model/');

switch ($eventName) {
    case 'OnBeforeSnipFormSave':
        $dirname = "snippets";
        $ext = "php";
        $file = $snippet;
        break;
    case 'OnBeforeChunkFormSave':
        $dirname = "chunks";
        $ext = "html";
        $file = $chunk;
        break;
    case 'OnBeforePluginFormSave':
        $dirname = "plugins";
        $ext = "php";
        $file = $plugin;
        break;
    case 'OnBeforeTempFormSave':
        $dirname = "templates";
        $ext = "html";
        $file = $template;
        $template = true;
        break;
}

if (!$file->get('static')) {

    if ($template == true) {
        $name = $file->get('templatename');
        $name = preg_replace('/\s+/', '', $name);
        $name = $sf->convertRUcharacters($name);
    } else {
        $name = $file->get('name');
    }

    $name = strtolower($name);

    $file->set('static', 1);
    $file->set('source', $modx->getOption('default_media_source', null, 1));
    $file->set('static_file', 'core/elements/' . $dirname . '/' . $name . '.' . $ext);
}