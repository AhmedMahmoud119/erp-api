<?php
if (!function_exists('sortDir')) {
    function sortDir($dir)
    {
        return $dir === 'asc' ? 'asc' : "desc";
    }
}