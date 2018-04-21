<?php

namespace App\Models;

use PDO;
use Core\Pagination;
use Core\Validation;

class Task extends \Core\Model
{
    /**
     * Запрос в БД
     *
     * @return array
     */
    public static function get($page, $count)
    {   
        $db = static::getDB();

        $sort = Validation::sort();

        $pagination = new Pagination($count , $page);

        $stmt = $db->query('SELECT id, username, email, text, file, checked FROM tasks '.
            ' ORDER BY ' . $sort . ' LIMIT ' . $pagination->start . ', '. $pagination->num);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Количество записей
     *
     * @return int
     */
    public static function count()
    {
        $db = static::getDB();
        
        $stmt = $db->query('SELECT COUNT(id) FROM tasks ');

        return (int)$stmt->fetchColumn();
    }

    /**
     * Выбрать один
     *
     * @return int
     */
    public static function find($id)
    {
        $db = static::getDB();
            
        $stmt = $db->prepare('SELECT id, username, email, text, file FROM tasks WHERE id = :id');

        $stmt->bindParam(':id', $id);
        
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *  Добавить запись в БД
     *
     *  @return boolean
     */
    public static function create($data, $table, $v = '', $j = 1)
    {
        $column = Task::parse($data);

        for ($i=0; $i < count($data); $i++) { 
            $v .= ',?';
        }

        $db = static::getDB();
        
        $stmt = $db->prepare('INSERT INTO ' . $table . ' (' . $column . ') VALUES (' . substr($v, 1) . ') ');

        foreach ($data as $key => $v) {
            $stmt->bindParam($j++, $data[$key]);
        }

        $stmt->execute();

        return true;
    }

    /**
     *  Обновление запись в БД
     *
     *  @return boolean
     */
    public static function update($data, $table, $j = 1)
    {

        $db = static::getDB();
        
        $stmt = $db->prepare('UPDATE ' . $table . ' SET username = :username, email = :email, text = :text , file = :file WHERE id = :id ');

        foreach ($data as $key => $v) {
            if ($key != 'id') {
                $stmt->bindParam(':'.$key, $data[$key]);    
            } else {
                $stmt->bindParam(':id', $data[$key]);  
            }           
        }

        $stmt->execute();

        return true;
    }

    /**
     *  Отметить как "Проверено"
     *
     *  @return boolean
     */
    public static function check($data)
    {
        $db = static::getDB();

        $stmt = $db->prepare('UPDATE tasks SET checked = 1 WHERE id = :id');
        
        $stmt->bindParam(':id', $data['checked']);

        $stmt ->execute();

        return true;
    }

    /**
     *  Получаем все столбцы
     *
     * @param array $data  полученные POST данные   
     * @param str $column  столбцы   
     *
     * @return str
     */
    private static function parse($data, $colunm = '')
    {
        foreach ($data as $key => $value) {
            $colunm .= ','.$key;
        }
        
        return substr($colunm, 1);
    }
}