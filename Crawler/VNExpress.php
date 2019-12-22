<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:41
 */

class Crawler_VNExpress implements Crawler_ICrawler
{
    /**
     * @var Crawler_Parser_VNExpress
     */
    private $_parser;

    private $_arrayIsWasScratched = [];

    public function __construct()
    {
        $this->_parser = new Crawler_Parser_VNExpress();
    }

    /**
     * @param string $url
     * @return Crawler_Model_Post
     * @throws Exception
     */
    public function crawl($url)
    {
        $url = str_replace('#box_comment', '', $url);

        if ($this->_isWasScratched($url)) {
            return null;
        }

        $html = Crawler_Curl::getInstance()->get($url);
        if (!$html) {
            throw new Exception('Can not get html from url: ' . $url);
        }
        $post = new Crawler_Model_Post();

        $data = $this->_parser->setHtml($html)->parse();

        // convert data raw to model
        $post->setUrl($url);
        $post->setArrayUrlInSide($data['allUrlInSide']);
        $post->setAuthor($data['author']);
        $post->setTitle($data['title']);
        $post->setCreatedAt($data['createdAt']);

        $this->_indexWasScratched($url);

        return $post;
    }

    /**
     * @param $url
     * @return false|int
     */
    public function isPost($url)
    {
        return preg_match('/(.*)-([0-9]*).html/', $url) && strpos($url, 'https://vnexpress.net') === 0;
    }

    private function _isWasScratched($url)
    {
        return in_array($url, $this->_arrayIsWasScratched);
    }

    private function _indexWasScratched($url)
    {
        $this->_arrayIsWasScratched[] = $url;
    }
}