<?php

namespace Core;



class Router
{

    /**
     * Роуты
     * @var array
     */
    protected $routes = [];

    /**
     * Параметры роута
     * @var array
     */
    protected $params = [];

    /**
     * Путь
     * @var string
     */
    protected $namespace = 'App\Controllers\\';

    /**
     * Данные
     * @var string
     */
    protected $data = null;

    /**
     * Добавить маршруты
     *
     * @param string $route  адрес url
     * @param array  $params контроллер и его метод
     *
     * @return void
     */
    public function add($route, $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route); /* экранируем слэшы */
        
        $p = explode('?', $route, 2); /* убираем лишние данные */

        $route = $p[0];

        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * Проверка
     *
     * @param string $url  путь
     *
     * @return boolean  
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                
                return true;
            }
        }

        return false;
    }

    /**
     * Запуск
     *
     * @param string $url The route URL
     *
     * @return void
     */
    public function processing($url)
    {
        $url = $this->removeQueryStringVariables($url);
        
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            
            $controller = $this->namespace . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];

                if (preg_match('/action$/i', $action) == 0) {
                    
                    $controller_object->$action($this->data);
                    
                } else {
                    throw new \Exception("Метод " . $action . " не найден в котроллере " . $controller);
                }
            } else {
                throw new \Exception("Контроллер " . $controller . " не найден");
            }
        } else {
            throw new \Exception('Не выбран маршрут', 404);
        }
    }

   /**
     * Удалить лишнии условий
     *
     * @param string $url  Полный путь
     *
     * @return string  Возвращаем путь без данных
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('?', $url, 2);

            if (isset($parts[1])) {
                if (strpos($parts[1], '=') !== false) {
                    $var = explode('=', $parts[1], 2);
                    $this->data = $var[1];
                }    
            }

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

}
