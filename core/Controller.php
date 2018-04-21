<?php

namespace Core;

class Controller
{

    /**
     * Параметры роута
     * @var array
     */
    protected $route_params = [];

    /**
     * @param array $route_params  Параметры из роута
     *
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Вызываем метод текущего контроллера
     *
     * @param string $name  имя метода
     * @param array $data  передаваемы данные
     *
     * @return void
     */
    public function __call($method, $data)
    {
        if (method_exists($this, $method)) {

            call_user_func_array([$this, $method], $data);
             
        } else {
            throw new \Exception($method." не найден в контроллере ".get_class($this));
        }
    }

}
