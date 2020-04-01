<?php


namespace Core;


class Entity
{
    public function __construct(array $params, ORM $ORM)
    {
        if (!isset($params["id"]))
            foreach ($params as $key => $value)
                $this->$key = $value;
        else {
            $tab = $ORM->read("users", $params["id"]);
            var_dump($tab, get_class_methods($ORM));
            var_dump($params["id"]);
            foreach ($tab[0] as $key => $value)
                $this->$key = $value;
        }
    }
}