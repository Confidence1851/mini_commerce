<?php
namespace App\Helpers;

class MetaData{

    public string $title;
    public string $description;
    public string $keywords;
    public string $author;
    public string $publisher;
    public string $copyright;
    public string $page_topic;
    public string $page_type;
    public string $audience;

    // <!__  Essential META Tags __>
    public string $og_site_name;
    public string $og_title;
    public string $og_description;
    public string $og_image;
    public string $og_url;
    public string $twitter_card;
    public string $twitter_image_alt;

    public function setAttribute($name , $value){
        $this->$name = $value;
        return $this;
    }

    public function generate(){
        $object_array = (array) $this;

        $class_variables =  get_class_vars(get_class($this));
        $merged_data = [];

        foreach ($class_variables as $key => $value) {
            $merged_data[$key] = $object_array[$key] ?? null;
        }

        return $merged_data;
    }
}

