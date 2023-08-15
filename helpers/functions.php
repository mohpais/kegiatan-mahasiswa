<?php
    function get_current_url() {
        $url = $_SERVER['REQUEST_URI'];
        $seperateUrl = explode("/", $url);
        $currentUrl = $seperateUrl[count($seperateUrl) - 1];
        $pageOfFile = explode(".", $currentUrl);
        $page = $pageOfFile[0];
        if( strpos($page, '-') ) {
            $seperatePage = explode("-", $page);
            $newUrl = "";
            for ($i=0; $i < count($seperatePage); $i++) { 
                $newUrl = $newUrl . ' ' . $seperatePage[$i];
            }
            $page = $newUrl;
        }

        return $page;
    }

    function active_navbar($fileName) {
        if (get_current_url()) {
            # code...
        }
    }
