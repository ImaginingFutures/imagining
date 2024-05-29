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
        return "{$this->authors} ({$this->year}). \"{$this->title}.\" {$this->object_id}. {$this->collection}. Imagining Futures. {$this->domain}/Detail/objects/{$this->object_id}. Accessed " . date("F j, Y") . ".";
    }

    public function mla() {
        return "{$this->authors}. \"{$this->title}.\" {$this->year}, {$this->collection}, {$this->object_id}, Imagining Futures, {$this->domain}/Detail/objects/{$this->object_id}. Accessed " . date("F j, Y") . ".";
    }

    public function chicago() {
        return "{$this->authors}. \"{$this->title}.\" {$this->object_id}. {$this->collection}. Imagining Futures. {$this->domain}/Detail/objects/{$this->object_id} ({$this->year}).";
    }
}
?>
