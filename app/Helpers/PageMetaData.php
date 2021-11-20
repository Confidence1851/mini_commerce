<?php

namespace App\Helpers;

use App\Helpers\MetaData;
use App\Models\Post;
use App\Models\Product;

class PageMetaData
{

    const DEFAULT_SUFFIX = "- Gelly";
    const DEFAULT_KEYWORDS = "E-commerce, Fashion, In-vogue";

    static public function getTitle(string $title)
    {
        return $title . " " . self::DEFAULT_SUFFIX;
    }

    static public function indexPage()
    {
        $meta = new MetaData();
        return $meta->setAttribute("title", self::getTitle("Home"))
            ->setAttribute("description", "Welcome to Gelly.com")
            ->setAttribute("keywords", self::DEFAULT_KEYWORDS)
            ->setAttribute("author", "")
            ->setAttribute("audience", "Public")
            ->generate();
    }

    static public function contactPage()
    {
        $meta = new MetaData();

        return $meta->setAttribute("title", self::getTitle("Contact Us"))
            ->setAttribute("description", "Rapid contacts")
            ->setAttribute("keywords", self::DEFAULT_KEYWORDS)
            ->setAttribute("author", "")
            ->setAttribute("audience", "Public")
            ->generate();

    }
    static public function about()
    {
        $meta = new MetaData();

        return $meta->setAttribute("title", self::getTitle("About Us"))
            ->setAttribute("description", "About us")
            ->setAttribute("keywords", self::DEFAULT_KEYWORDS)
            ->setAttribute("author", "")
            ->setAttribute("audience", "Public")
            ->generate();

    }

    static public function blogPage($type)
    {
        $meta = new MetaData();
        return $meta->setAttribute("title", self::getTitle(ucfirst($type)))
            ->setAttribute("description", "Blog descrpition")
            ->setAttribute("keywords", self::DEFAULT_KEYWORDS)
            ->generate();
    }

    static public function searchPage($title = null)
    {
        $meta = new MetaData();
        if(empty($title)){
            $title = "Search";
        }
        return $meta->setAttribute("title", self::getTitle($title))
            ->setAttribute("description", "Blog descrpition")
            ->setAttribute("keywords", self::DEFAULT_KEYWORDS)
            ->generate();
    }

    static public function blogDetailsPage(Post $post)
    {
        $meta = new MetaData();
        $title = $post->meta_title ?? $post->title;
        return $meta->setAttribute("title", self::getTitle($title))
            ->setAttribute("description", $post->meta_description)
            ->setAttribute("keywords",$post->meta_keywords ?? self::DEFAULT_KEYWORDS)
            ->setAttribute("author", optional($post->author)->names() ?? "Admin")
            ->setAttribute("page_topic", $post->title)
            ->setAttribute("og_site_name", url("/"))
            ->setAttribute("og_title", $post->title)
            ->setAttribute("og_description", $post->meta_description)
            ->setAttribute("og_image", $post->coverImageUrl())
            ->setAttribute("og_url", $post->detailsUrl())
            ->setAttribute("twitter_card", $post->coverImageUrl())
            ->setAttribute("twitter_image_alt", $post->title)
            ->generate();
    }

    static public function cartPage()
    {
        $meta = new MetaData();

        return $meta->setAttribute("title", self::getTitle("My Cart"))
            ->setAttribute("description", "Cart")
            ->setAttribute("keywords", self::DEFAULT_KEYWORDS)
            ->setAttribute("author", "")
            ->setAttribute("audience", "Public")
            ->generate();

    }

    static public function checkoutPage()
    {
        $meta = new MetaData();

        return $meta->setAttribute("title", self::getTitle("Checkout"))
            ->setAttribute("description", "CHeckout")
            ->setAttribute("keywords", self::DEFAULT_KEYWORDS)
            ->setAttribute("author", "")
            ->setAttribute("audience", "Public")
            ->generate();

    }

    static public function shopPage()
    {
        $meta = new MetaData();

        return $meta->setAttribute("title", self::getTitle("Shop"))
            ->setAttribute("description", "Shop for the best fasjion products")
            ->setAttribute("keywords", self::DEFAULT_KEYWORDS)
            ->setAttribute("author", "")
            ->setAttribute("audience", "Public")
            ->generate();

    }

    static public function productDetailsPage(Product $product)
    {
        $meta = new MetaData();
        $title = $product->meta_title ?? $product->name ?? "";
        $description =  $product->meta_description ?? $product->description ?? "";
        return $meta->setAttribute("title", self::getTitle($title))
            ->setAttribute("description", $description)
            ->setAttribute("keywords",$product->meta_keywords ?? self::DEFAULT_KEYWORDS)
            ->setAttribute("author", "Admin")
            ->setAttribute("page_topic", $product->name)
            ->setAttribute("og_site_name", $product->detailUrl())
            ->setAttribute("og_title", $product->name)
            ->setAttribute("og_description", $description)
            ->setAttribute("og_image", $product->getDefaultImage())
            ->setAttribute("og_url", $product->detailUrl())
            ->setAttribute("twitter_card", $product->getDefaultImage())
            ->setAttribute("twitter_image_alt", $product->name)
            ->generate();
    }

}
