<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:42
 */

interface Crawler_ICrawler
{
    /**
     * @param string $url
     * @return Crawler_Model_Post
     */
    public function crawl($url);

    public function isPost($url);
}