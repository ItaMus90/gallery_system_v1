<?php


class Paginate {


    //Regular properties
    public $page = null;
    public $items_per_page = null;
    public $items_total_count = null;


    //Regular methods
    public function __construct($page = 1, $items_per_page = 4, $items_total_count = 0){

        $this->page              = (int)$page;
        $this->items_per_page    = (int)$items_per_page;
        $this->items_total_count = (int)$items_total_count;

    }

}