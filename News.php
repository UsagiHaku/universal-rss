<?php

class News {
    var $title;
    var $link;
    var $date;
    var $description;

    /**
     * News constructor.
     * @param $title
     * @param $link
     * @param $date
     * @param $description
     */
    public function __construct($title, $link, $date, $description)
    {
        $this->title = $title;
        $this->link = $link;
        $this->date = $date;
        $this->description = $description;
    }
}