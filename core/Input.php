<?php

namespace Core;

use Core\Validation;
use Core\Lib\Image\ImageResize;

class Input
{
    /**
     *  Получеам форму с данными
     *
     *  @return array
     */
	public static function get($data = '')
    {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    		foreach ($_POST as $key => $value) {
    			$data[$key] = htmlspecialchars($value); /* Данные формы */
    		}
    	}

        return $data;
    }

    /**
     *  Обработка загруженной картинки
     *
     *  @return boolean
     */
    public static function file()
    {
        if ($_FILES['file']['name'] != '') {
            $bool = Validation::file(); /* Проверка mime type */

            $file = dirname(__DIR__) . '\public\files\\' . basename($_FILES['file']['name']); /* Директория файла */

            if ($bool && move_uploaded_file($_FILES['file']['tmp_name'], $file)) { /* Перемещаем в новую директорию */

                Input::resize($file); /* Ресайз картинки */

                return basename($_FILES['file']['name']);

            } else {

                return false;

            }
        }

        return false;
    }

    /**
     *  Ресайз изборожения
     *
     *  @param str $img  путь до файла
     *  @return boolean
     */
    private static function resize($img)
    {
        $imageinfo = getimagesize($img); /* узнаем размеры */
          
        $x = $imageinfo[0]; /* Длина */
        $y = $imageinfo[1]; /* Ширина */

        if ($x != 320 ||$y != 240)
        {
            $image = new ImageResize($img);
            $image->resize(320, 240, $allow_enlarge = true); /* Задаем нужный размер */
            $image->save($img);            
        }

        return true;
    }
}