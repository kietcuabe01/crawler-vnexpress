<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 13:34
 */

class Crawler_Parser_VNExpress
{
    /**
     * @var string
     */
    private $_html;

    /**
     * @var DOMDocument
     */
    private $_dom;

    /**
     * @var DomXPath
     */
    private $_finder;

    public function __construct()
    {
        $this->_dom = new DOMDocument('1.0');
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->_html;
    }

    /**
     * @param $html
     * @return $this
     */
    public function setHtml($html)
    {
        $this->_html = $html;
        return $this;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function parse()
    {
        $dom = $this->_dom;
        @$dom->loadHTML($this->getHtml());

        $this->_finder = new DomXPath($this->_dom);

        $nodesTitle = $this->_dom->getElementsByTagName('h1');
        if (!$nodesTitle->item(0)) {
            throw new Exception('Get Post Title: Html Structure is changed by VNExpress');
        } else {
            $title = $nodesTitle->item(0);
        }

        $nodeTime = $this->_getByClass('time left');
        if (!$nodeTime->item(0)) {
            throw new Exception('Get Post CreatedAt: Html Structure is changed by VNExpress');
        } else {
            $createdAt = $nodeTime->item(0);
        }

        $nodeAuthor = $this->_getByClass('author_mail');
        if (!$nodeAuthor->item(0)) {
            $nodeAuthor = $this->_getByClass('fck_detail width_common');
            $author = $nodeAuthor->item($nodeAuthor->length-1);
            if (!$author || strlen($author->nodeValue) > 1000) {
                $author = $this->_getByClass('Normal');
                $author = $author->item(0);
            }
        } else {
            $author = $nodeAuthor->item(0);
        }

        if (!$author || strlen($author->nodeValue) > 1000) {
            throw new Exception('Get Author CreatedAt: Html Structure is changed by VNExpress');
        }

        $nodesAllUrl = $this->_dom->getElementsByTagName('a');

        $allUrl = [];

        foreach ($nodesAllUrl as $nodeTagUrl) {
            /** @var DOMElement $nodeTagUrl */
            $url = $nodeTagUrl->getAttribute('href');

            #only get full url
            if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                $allUrl[] = $url;
            }
        }

        return [
            'title' => $this->_convertUtf8(trim($title->nodeValue)),
            'createdAt' => $this->_convertUtf8(trim($createdAt->nodeValue)),
            'author' => $this->_convertUtf8(trim($author->nodeValue)),
            'allUrlInSide' => $allUrl,
        ];
    }

    /**
     * @param $className
     * @return DOMNodeList
     */
    private function _getByClass($className)
    {
        $nodes = $this->_finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");
        return $nodes;
    }

    private function _convertUtf8($string)
    {
        return utf8_decode($string);
    }

    private function _trim($string)
    {
        $string = trim($string);

        return $string;
    }

}