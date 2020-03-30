<?php


namespace Core;


class Request
{
    public function secure():bool
    {
        foreach ($_POST as &$value)
            $value = stripslashes(htmlspecialchars(strip_tags(trim($value))));
        foreach ($_GET as &$value)
            $value = stripslashes(htmlspecialchars(strip_tags(trim($value))));
        return true;
    }
}