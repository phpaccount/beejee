<?php

namespace Core;

class Pagination
{
    /**
     * Всего страниц
     * @var int
     */
    public $total;

    /**
     * Начиная с N записи
     * @var int
     */
    public $start;

    /**
     * Количество на странице
     * @var int
     */
    public $num = 3;


    /**
     * Конструктор
     * @param   int $page  Текущяя страница
     * @param   int $count  Всего в таблице данных
     */
    public function __construct($count, $page = 1) {
        
        if (empty($page)) {
            $page = 1;
        }

        $this->total($count);

        $this->start = $page * $this->num - $this->num; /* Начиная с start выбрать 3 записи */
    }

    /**
     *  Количество страниц
     *
     *  @return boolean
     */
    private function total($count)
    {
        $this->total = intval(($count - 1) / $this->num) + 1;  

        if ($this->total > 1) {

            return $this->total;

        }

        return false;        
    }

}