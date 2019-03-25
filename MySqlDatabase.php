<?php

require 'News.php';

class MySqlDatabase {
    var $connection;

    function __construct() {
        $this->start_connection();
    }

    function start_connection() {
        $this->connection = mysqli_connect('localhost','root','','UniversalDB');

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    function delete_news() {
        mysqli_query($this->connection, "DELETE FROM NewsInfo");
    }

    function get_news_count() {
        $result =  mysqli_query($this->connection,"select * from NewsInfo");
        $newsCount = mysqli_num_rows($result);
        return $newsCount;
    }

    function get_first_news() {
        return mysqli_query($this->connection,"select date from NewsInfo LIMIT 1")->fetch_assoc();
    }

    function add_news(News $news) {
        $query = "insert into NewsInfo (link,title,date,description) values ('$news->link','$news->title','$news->date','$news->description')";
        mysqli_query($this->connection, $query);
    }

    function get_news($orderBy) {
        $news = [];

        $query = "SELECT id, description, title, date, link FROM NewsInfo ORDER BY " . $orderBy . " ASC";
        $result = mysqli_query($this->connection, $query);

        while($row = mysqli_fetch_assoc($result)){
            $currentNew = new News(
                $row['title'],
                $row['link'],
                $row['date'],
                $row['description']
            );

            array_push($news, $currentNew);
        }

        return $news;
    }

    function get_news_by_id($id){
        $query= "SELECT description, title, date, link FROM NewsInfo WHERE title LIKE '%$id%'";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_array($result);
        $newsById = new News(
            $row['title'],
            $row['link'],
            $row['date'],
            $row['description']
        );
        return $newsById;
    }
}