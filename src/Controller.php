<?php
/**
 * @package evas-php/evas-mvc
 */
namespace Evas\Mvc;

use Evas\Base\App;

/**
 * Константы для свойств класса по умолчанию.
 */
if (!defined('EVAS_VIEW_PATH')) define('EVAS_VIEW_PATH', 'view/');

/**
 * Controller.
 * @author Egor Vasyakin <egor@evas-php.com>
 * @since 1.0
 */
class Controller
{
    /**
     * @var string директория файлов отображения
     */
    public $viewPath = EVAS_VIEW_PATH;

    /**
     * Получение полного имени файла.
     * @param string относительный путь к файлу
     * @return string полный путь к файлу
     */
    public function filename(string $filename): string
    {
        return App::getDir() . $this->viewPath . $filename;
    }

    /**
     * Рендер файла/шаблона.
     * @param string имя файла/шаблона
     * @param array аргументы для файла
     * @throws Evas\Base\Exception\FileNotFoundException
     * @return mixed|null возвращаемый результат файла
     */
    public function render(string $filename, array $args = [])
    {
        return App::load($this->filename($filename), $args, $this);
    }

    /**
     * Проверка на возможность рендера.
     * @param string имя файла/шаблона
     * @return bool удалось ли прочитать файл
     */
    public function canRender(string $filename): bool
    {
        return App::canLoad($this->filename($filename));
    }
}
