<?php

require 'MySqlDatabase.php';
require_once 'vendor/simplepie/simplepie/autoloader.php';

class NewsController {
    var $db;
    var $feed;
    var $rssUrl ='http://archivo.eluniversal.com.mx/rss/notashome.xml';

    function __construct() {
        $this->db = new MySqlDatabase();

        $this->db->start_connection();

        $this->feed = new SimplePie();
        $this->feed->set_feed_url($this->rssUrl);
        $this->feed->init();

        $item = $this->feed->get_item(0);
        $date = $item->get_date('Y-m-d H:i:s');
        $itemQty = $this->feed->get_item_quantity();

        if($this->isSameDay($date)){
            if($this->hasMoreNews($itemQty)){
                $numRows = $this->db->get_news_count();
                $newsForAdd = $itemQty - $numRows;
                $this->addNewsToDB(0,$newsForAdd);
            }
        }else{
            $this->db->delete_news();
            $this->addNewsToDB(0,$itemQty);
        }
    }

    function isSameDay($date){
        $firstDate = $this->db->get_first_news()['date'];

        $isSameDay = $this->get_simple_format_date($date) == $this->get_simple_format_date($firstDate);

        if($isSameDay){
            return true;
        }
        return false;
    }

    function hasMoreNews($itemQty){
        $numRows = $this->db->get_news_count();

        if($numRows<$itemQty){
            return true;
        }
        return false;
    }

    function addNewsToDB($i,$itemQty){
        for($i; $i < $itemQty; $i++) {

            $item = $this->feed->get_item($i);
            $link = $item->get_link();
            $title = $item->get_title();
            $date = $item->get_date('Y-m-d H:i:s');
            $description = $item->get_description();

            $selectedNews = new News($title, $link, $date, $description);
            $this->db->add_news($selectedNews);
        }
    }

    function get_simple_format_date($date) {
        return date('Y-m-d', strtotime($date));
    }

    function get_news() {
        return $this->db->get_news();
    }

    function  get_news_by_id($id){
        return $this->db->get_news_by_id($id);
    }
}