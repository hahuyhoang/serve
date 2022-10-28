<?php

use Illuminate\Support\Facades\Storage;

function getAssetUrl($path)
{
    if (strpos(config('app.url'), 'ap.ngrok.io') !== false) {
        return $path;
    }
    // if(($cdn_url = setting('site.cdn_url')) && trim($cdn_url)){
    //   return trim($cdn_url).$path;
    // }
    $useAsset = env('USE_ASSET', true);
    if ($useAsset) {
        return asset($path);
    } else {
        return $path;
    }
}


function getBaseURI($url)
{
    $parse = parse_url($url);
    $baseUrl = '';
    if (isset($parse['host'])) {
        if (isset($parse['scheme'])) {
            $baseUrl =  str_replace($parse['scheme'] . '://' . $parse['host'], '', $url);
        } else
            $baseUrl =  str_replace($parse['host'], '', $url);
    }
    if (isset($parse['port'])) {
        $baseUrl = str_replace(':' . $parse['port'], '', $baseUrl);
    }

    return $baseUrl;
}

function setting($key)
{
    //    return \App\Models\Setting::getSettingItem($key);
}

function isFileName($fileName)
{
    $fileName = preg_replace('/\s+/', '_', $fileName);
    return preg_match('/^[a-zA-Z0-9_.\-\(\)]+$/', $fileName);
}

function formatFileName($fileName)
{
    return str_replace(['(', ')'], ['', ''], preg_replace('/\s+/', '_', $fileName));
}

function addLinkUnsubscribe($emailContent, $linkUnsubscribe, $textUnsubscribe = 'Unsubscribe')
{
    return preg_replace('/\[unsubscribe_link\]/', $linkUnsubscribe, $emailContent);
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function makeKeyTranslate($listKey, &$trans, $value)
{
    if (count($listKey) > 1) {
        if (!isset($trans[$listKey[0]])) {
            $trans[$listKey[0]] = [];
            array_splice($listKey, 0, 1);
            $trans = makeKeyTranslate($listKey, $trans[$listKey[0]], $value);
        }
    } else {
        $trans[$listKey[0]] = $value;
    }
    return $trans;
}

function UploadImg($param, $folder)
{
    foreach ($param as $img) {
        list($extension, $content) = explode(';', $img);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return $folder . '/' . $fileName;
    }
}
function UploadImgApp($img, $folder)
{
    list($extension, $content) = explode(';', $img);
    $tmpExtension = explode('/', $extension);
    preg_match('/.([0-9]+) /', microtime(), $m);
    $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
    $content = explode(',', $content)[1];
    $storage = Storage::disk('public');

    $checkDirectory = $storage->exists($folder);

    if (!$checkDirectory) {
        $storage->makeDirectory($folder);
    }

    $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

    return $folder . '/' . $fileName;
}
