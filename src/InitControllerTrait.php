<?php
/**
 * @package evas-php/evas-mvc
 */
namespace Evas\Mvc;

use Evas\Base\Exception\FileNotFoundException;
use Evas\Mvc\Controller;

/**
 * Константы для свойств трейта по умолчанию.
 */
if (!defined('EVAS_CONTROLLER_CLASS')) define('EVAS_CONTROLLER_CLASS', Controller::class);

/**
 * Расширение инициализации класса контроллера.
 * @author Egor Vasyakin <egor@evas-php.com>
 * @since 1.0
 */
trait InitControllerTrait
{
    /**
     * @var string имя класса контроллера
     */
    public $controllerClass = EVAS_CONTROLLER_CLASS;

    /**
     * Установка имени класса контроллера.
     * @param string имя класса
     * @return self
     */
    public function controllerClass(string $controllerClass)
    {
        $this->controllerClass = &$controllerClass;
        return $this;
    }

    /**
     * Получение имени класса контроллера.
     * @return string|null
     */
    public function getControllerClass(): ?string
    {
        return $this->controllerClass;
    }

    /**
     * Создание экземпляра класса контроллера.
     * @param string|null имя класса
     * @param array|null аргументы конструктора
     * @throws FileNotFoundException
     * @return object
     */
    public function newController(string $controllerClass = null, array $args = null): object
    {
        if (empty($controllerClass)) {
            $controllerClass = $this->getControllerClass();
        }
        if (!class_exists($controllerClass, true)) {
            throw new FileNotFoundException("Controller class \"$controllerClass\" not found");
        }
        return new $controllerClass($args);
    }
}
