<?php

require_once 'vendor/simplepie/simplepie/autoloader.php';

$url ='http://archivo.eluniversal.com.mx/rss/notashome.xml';
$feed = new SimplePie();
$feed->set_feed_url($url);
$feed->init();

$connection = mysqli_connect('localhost','root','','UniversalDB');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
else{

    $item = $feed->get_item(0);
    $date = $item->get_date('Y-m-d H:i:s');
    $itemQty = $feed->get_item_quantity();

    if(isSameDay($date,$connection)){
        if(hasMoreNews($itemQty,$connection)){
            $numRows = newsInfoRows($connection);
            $newsForAdd = $itemQty - $numRows;
            addNewsToDB(0,$newsForAdd,$feed,$connection);
        }
    }else{



        $sql = " delete from NewsInfo";
        $deleteCurrentDB = mysqli_query($connection,$sql);
        addNewsToDB(0,$itemQty,$feed,$connection);
    }
}

function isSameDay($date, $connection){
    $sql ="select date from NewsInfo LIMIT 1";
    $DB_Date = mysqli_query($connection,$sql)->fetch_assoc()['date'];

    //var_dump($DB_Date);

    if($date == $DB_Date){
        return true;

    }
    return false;
}

function hasMoreNews($itemQty, $connection){
    $NumRows = newsInfoRows($connection);

    if($NumRows<$itemQty){
        return true;
    }
    return false;
}

function newsInfoRows($connection){
    $sql = "select * from NewsInfo";
    $result =  mysqli_query($connection,$sql);
    $NumRows = mysqli_num_rows($result);
    return $NumRows;
}

function addNewsToDB($i,$itemQty,$feed,$connection){
    for($i; $i < $itemQty; $i++) {

        $item = $feed->get_item($i);
        $link = $item->get_link();
        $title = $item->get_title();
        $date = $item->get_date('Y-m-d H:i:s');
        $description = $item->get_description();
       // $content = $item->get_content(true);
        $sql = "insert into NewsInfo (link,title,date,description) values ('$link','$title','$date','$description')";
        $AddDB = mysqli_query($connection, $sql);
    }
}


