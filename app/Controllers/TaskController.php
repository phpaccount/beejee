<?php

namespace App\Controllers;

use Core\View;
use Core\Input;
use Core\Pagination;
use Core\Validation;

use App\Models\Task;
use App\Models\User;

class TaskController extends \Core\Controller
{
	
	/**
	 *	Вывод списка задач
	 *
	 *	@var @page  страница
	 *	@return view
	 */
	protected function index($page)
	{	
		$username = User::auth();

		$count = Task::count(); /* Количество записей */

		$pagination = new Pagination($count , $page); /* Пагинация */

		$data = Task::get($page, $count); /* Данные на вывод */

		return View::render('index', compact('data', 'pagination', 'username'));
	}

	/**
	 *	Открыть станицу добавления
	 *
	 *	@return view
	 */
	protected function create()
	{	
		return View::render('create');
	}

	/**
	 *	Открыть станицу редактирование
	 *
	 *	@return void
	 */
	protected function edit($id)
	{	
		$data = Task::find($id); /* Данные на вывод */
		
		if (isset($data)) {
			
			extract($data[0], EXTR_OVERWRITE);
			
			$img = $file;

			$action = '/task/update';

			return View::render('create', compact('id', 'username', 'text', 'img', 'email', 'action'));
		}

		return false;
	}

	/**
	 *	Сохранить запись
	 *
	 *	@return view
	 */
	protected function store()
	{	
		$file = Input::file(); /* Картинка */

		$data = Input::get(); /* Получаем форму */

			$data["file"] = $file; /**/

		Task::create($data, 'tasks'); /* Сохраняем в БД */
		
		header("Location: http://".$_SERVER['HTTP_HOST']);
	}

	/**
	 *	Обновить запись
	 *
	 *	@return view
	 */
	protected function update()
	{	
		$file = Input::file(); /* Картинка */

		$data = Input::get(); /* Получаем форму */

		if (!$file) {
			$file = Task::find($data['id']); /* Данные на вывод */
			$file = $file[0]['file'];
		}

		$data["file"] = $file; /* Путь к файлу */

		var_dump($data);
		Task::update($data, 'tasks'); /* Сохраняем в БД */
		
		header("Location: http://".$_SERVER['HTTP_HOST']);
	}

	/**
	 *	Отметить как "Проверено"
	 *
	 *	@return view
	 */
	protected function check()
	{			
		$data = Input::get(); /* Получаем форму */

		Task::check($data); /* Сохраняем в БД */
		
		header("Location: http://".$_SERVER['HTTP_HOST']);
	}

}