<?php
class Cite {
    private $authors;
    private $year;
    private $title;
    private $object_id;
    private $collection;
    private $domain;

    public function __construct($authors, $year, $title, $object_id, $collection, $domain) {
        $this->authors = $authors;
        $this->year = $year;
        $this->title = $title;
        $this->object_id = $object_id;
        $this->collection = $collection;
        $this->domain = $domain;
    }

    public function apa() {
        if(!$this->authors){
            return "\"{$this->title}.\" ({$this->year}). {$this->object_id}. {$this->collection}. Imagining Futures. {$this->domain}. Accessed " . date("F j, Y") . ".";
        } 
        return "{$this->authors} ({$this->year}). \"{$this->title}.\" {$this->object_id}. {$this->collection}. Imagining Futures. {$this->domain}. Accessed " . date("F j, Y") . ".";
    }

    public function mla() {
        if(!$this->authors){
            return "\"{$this->title}.\" {$this->year}, {$this->collection}, {$this->object_id}, Imagining Futures, {$this->domain}. Accessed " . date("F j, Y") . ".";
        }
        return "{$this->authors}. \"{$this->title}.\" {$this->year}, {$this->collection}, {$this->object_id}, Imagining Futures, {$this->domain}. Accessed " . date("F j, Y") . ".";
    }

    public function chicago() {
        if(!$this->authors){
            return "\"{$this->title}.\" {$this->object_id}. {$this->collection}. Imagining Futures. {$this->domain} ({$this->year}).";
        }
        return "{$this->authors}. \"{$this->title}.\" {$this->object_id}. {$this->collection}. Imagining Futures. {$this->domain} ({$this->year}).";
    }
}
?>
