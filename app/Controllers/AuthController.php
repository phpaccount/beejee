<?php

namespace App\Controllers;

use Core\View;
use Core\Input;

use App\Models\User;

class AuthController extends \Core\Controller
{
	/**
	 *	Страница аутентификаций
	 *
	 *	@return view 
	 */
	protected function index()
	{
		return View::render('login');
	}

	/**
	 *	Авторизация
	 *
	 *	@return view 
	 */
	protected function login()
	{
		$data = Input::get(); /* Получаем форму */

		$pass = User::login($data); /* Получаем пароль */

		if (password_verify($data['password'], $pass)) { /* Если пароль совпатают */

            $token = User::token($data['username']); /* Создаем токен */

			session_start();

			$_SESSION['token'] = $token; /* Храним в сессий */

			header("Location: http://".$_SERVER['HTTP_HOST']);

		} else {

			return $this->index(); /* Возврат на страницу аутентификаций */

		}
	}

	/**
	 *	Выйти
	 *
	 *	@return void
	 */
	protected function logout()
	{
		session_start();

		$_SESSION['token'] = ''; /* Удаляем сессию */

		header("Location: http://".$_SERVER['HTTP_HOST']);
	}
}
