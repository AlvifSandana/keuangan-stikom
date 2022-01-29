<?php

/**
 * Return true if $mimeType is php.
 * 
 */
function check_file_type(String $mimeType = '')
{
    $status = false;
    switch ($mimeType) {
        case '':
            $status = 'mimeType empty!';
            return $status;
        case 'text/php':
            $status = true;
            return $status;
            break;
        case 'text/x-php':
            $status = true;
            return $status;
            break;
        case 'application/php':
            $status = true;
            return $status;
            break;
        case 'application/x-php':
            $status = true;
            return $status;
            break;
        case 'application/x-httpd-php':
            $status = true;
            return $status;
            break;
        case 'application/x-httpd-php-source':
            $status = true;
            return $status;
            break;
        default:
        return $status;
            break;
    }
}