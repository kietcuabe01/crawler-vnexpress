<?php

require_once 'bootstrap.php';
$screenHandler = Output_Factory::create('screen');

$urlCrawl = 'https://vnexpress.net/thoi-su/dung-600-cay-tre-lam-cau-100-m-qua-xom-giua-song-4030834.html';
try {
    $managerCrawler = new Crawler_CrawlerManager();
    $screenHandler->setData('Begin crawl VnExpress: '.$urlCrawl)->write();
    $arrayPost = $managerCrawler->exec($urlCrawl);
    $sheet = [];
    foreach ($arrayPost as $post) {
        /** @var Crawler_Model_Post $post */
        $line = $post->toArray();
        unset($line['ArrayUrlInSide']);

        $sheet[] = $line;
    }

    $csvHandler = Output_Factory::create('csv');
    $path = __DIR__.'/result.csv';
    $isWriteSuccess = $csvHandler->setData($sheet)->write($path);

    if (!$isWriteSuccess) {
        $screenHandler->setData('Cannot write csv to path: '.$path)->write();
    } else {
        $screenHandler->setData('Write data csv success, path: '.$path)->write();
    }
} catch (Exception $exception) {

    $messageError =
        "File: {$exception->getFile()}". PHP_EOL.
        "Line: {$exception->getLine()}" . PHP_EOL .
        "Error: {$exception->getMessage()}";

    $screenHandler->setData($messageError)->write();
}