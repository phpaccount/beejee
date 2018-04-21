<?php

namespace App\Models;

use PDO;
use Core\Pagination;
use Core\Validation;

class User extends \Core\Model
{
    /**
     * Запрос в БД, взять пароль юзера для проверки
     *
     * @return array
     */
    public static function auth()
    {   
        $db = static::getDB();

        $user = [''];

        $stmt = $db->prepare('SELECT username, token FROM users WHERE token = :token LIMIT 1 ');

        session_start();

        $stmt->bindParam(':token', $_SESSION['token']); 
        
        $stmt->execute();

        $user = $stmt->fetchAll();
        
        if (isset($user[0])) {
            return $user[0]['username'];    
        } else {
            return false;
        }
        
    }

    /**
     * Проверка авторизован ли пользователь
     *
     * @return array
     */
    public static function login($data)
    {   
        $db = static::getDB();

        $stmt = $db->prepare('SELECT password FROM users WHERE username = :username LIMIT 1 ');

        $stmt->bindParam(':username', $data['username']); 
        
        $stmt ->execute();

        $password = $stmt->fetchAll();
        
        return $password[0]['password'];
    }

    /**
     *	Создать токен пользователя
     *
     *	@return string
     */
    public static function token($username)
    {
        $db = static::getDB();

    	$token = password_hash(uniqid(rand(), true), PASSWORD_DEFAULT);

    	$stmt = $db->prepare('UPDATE users SET token = :token WHERE username = :username ');

        $stmt->bindParam(':username', $username); 
        $stmt->bindParam(':token', $token); 
        
        $stmt ->execute();

    	return $token;
    }

}