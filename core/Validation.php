<?php

namespace Core;

class Validation
{
	/**
	 *	Проверка сортировки задач
	 *
	 *	@return string
	 */
	public static function sort()
	{
		if (isset($_COOKIE['sort'])) {

			$name = $_COOKIE['sort'];

			$column = array_search($name, [	
							'usermane',
							'checked',
							'email'
						] );

			if ($column >= 0) {
				return $name;
			}
		}

		return 'id';		
	}

	/**
	 *	Проверка файла
	 *
	 *	@return boolean
	 */
	public static function file()
	{
		$type = $_FILES['file']['type'];

		$bool = array_search($type, [	
						'image/jpeg',
				        'image/gif',
				        'image/png'
					] );

		if ($bool >= 0) {

			return true; 

		} else {

			return false;
		}
	}
}