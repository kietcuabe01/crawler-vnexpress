<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:49
 */

class Crawler_CrawlerManager
{
    /**
     * @var Crawler_ICrawler
     */
    private $_slave;

    /**
     * Crawler_CrawlerManager constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->_slave = Crawler_Factory::create('VNExpress');
    }

    /**
     * @param string $url
     * @return array
     * @throws Exception
     */
    public function exec($url)
    {
        $result = [];

        if ( ! $this->_slave->isPost($url)) {
             throw new Exception('Url is not a post');
        }

        $post = $this->_slave->crawl($url);
        $result[] = $post;

        $arrayUrlInSide = $post->getArrayUrlInSide();

        foreach ($arrayUrlInSide as $otherUrl) {
            if (!$this->_slave->isPost($otherUrl)) {
                continue;
            }
            $otherPost = $this->_slave->crawl($otherUrl);

            if ($otherPost instanceof Crawler_Model_Post) {
                $result[] = $otherPost;
            }
        }

        return $result;
    }
}