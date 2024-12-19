<?php

namespace Chat\Http;


/**
 * Represents a set for utils
 */
class Utils
{

    /**
     * Do redirect to page url
     * @param string $url
     * @param int $responseCode
     * @return void
     */
    public static function RedirectToPage(string $url, int $responseCode = 302) {
        header("Location: $url", true, $responseCode);
        exit();
    }
}
