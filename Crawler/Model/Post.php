<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:42
 */

class Crawler_Model_Post
{
    private $title;

    private $author;

    private $createdAt;

    private $url;

    private $arrayUrlInSide;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getArrayUrlInSide()
    {
        return $this->arrayUrlInSide;
    }

    /**
     * @param mixed $arrayUrl
     */
    public function setArrayUrlInSide($arrayUrl)
    {
        $this->arrayUrlInSide = $arrayUrl;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function toArray()
    {
        return [
            'Url' => $this->getUrl(),
            'Title' => $this->getTitle(),
            'Author' => $this->getAuthor(),
            'Date' => $this->getCreatedAt(),
            'ArrayUrlInSide' => $this->getArrayUrlInSide(),
        ];
    }
}