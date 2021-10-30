<?php

namespace App\Helpers;

use App\Models\Post;

class SocialShareHelper
{

    public function getLink($platform , $postUrl)
    {
        $url = $postUrl;
        $link = $postUrl;
        if($platform == "facebook"){
            $link = $this->shareOnFacebook($url);
        }
        if($platform == "telegram"){
            $link = $this->shareOnTelegram($url);
        }
        if($platform == "whatsapp"){
            $link = $this->shareOnWhatsapp($url);
        }
        return $link;
    }

    public function shareOnFacebook($url)
    {
        return "https://web.facebook.com/sharer.php?u=$url";
    }
    public function shareOnTelegram($url)
    {
        return "https://telegram.me/share/?url=$url";
    }
    public function shareOnWhatsapp($url)
    {
        return "https://wa.me/?text=$url";
    }
}
