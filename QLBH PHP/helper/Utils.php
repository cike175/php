<?php
require_once './entities/Product.php';
define('PAGE_PER_NO',5); 
class Utils {

    public static function RedirectTo($url) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $url");
    }
    public static function cmp($a, $b) {
        if ($a->getNewPrice() == $b->getNewPrice()) {
            return 0;
        }
        return ($a->getNewPrice() < $b->getNewPrice()) ? -1 : 1;
    }
    

}
function getPagination($count){
      $paginationCount= floor($count / PAGE_PER_NO);
      $paginationModCount= $count % PAGE_PER_NO;
      if(!empty($paginationModCount)){
               $paginationCount++;
      }
      return $paginationCount;
      
      }