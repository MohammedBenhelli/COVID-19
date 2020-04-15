<?php


namespace Core;


class Request
{
    public function secure(array &$params = []):bool
    {
        foreach ($params as &$value)
            $value = stripslashes(htmlspecialchars(strip_tags(trim($value))));
        foreach ($_POST as &$value)
            $value = stripslashes(htmlspecialchars(strip_tags(trim($value))));
        foreach ($_GET as &$value)
            $value = stripslashes(htmlspecialchars(strip_tags(trim($value))));
        return true;
    }
}