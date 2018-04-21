<?php

namespace Core;

class View
{ 
    /**
     * Генерация страниц
     *
     * @param string $content  Файл шаблон
     * @param array $data  Ассоциативный массив данных ( запакован через compact )
     * @param string $template  имя главного шаблона
     *
     * @return void
     */
    public static function render($content, $data = [], $template = 'app')
    {
        $expansion = '.php';

        extract($data, EXTR_OVERWRITE); /* Извлечь переменные из ассоциативного массива */

        $file = dirname(__DIR__) . "\App\Views\\" . $content . $expansion; /* Полный путь до файла */
        
        if (is_readable($file)) {
            require '..' . "\App\Views\\" . $template . $expansion;
        } else {
            throw new \Exception("Файл " . $file . " не найден");
        }
    }
}