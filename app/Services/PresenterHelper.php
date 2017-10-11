<?php
/**
 * Author: Anton Orlov
 * Date: 10.10.2017
 * Time: 23:21
 */

namespace App\Services;


use App\Presenters\PresenterInterface;

class PresenterHelper
{
    const ANNOTATION = '@presenter';

    /**
     * @param string $action
     * @return PresenterInterface
     */
    public static function getPresenter(string $action): PresenterInterface
    {
        $result = null;
        if (strpos($action, '@') === false) {
            return $result;
        }
        list($class, $method) = explode('@', $action);
        $reflection = new \ReflectionClass($class);
        if ($reflection->hasMethod($method)) {
            $method = $reflection->getMethod($method);
            $lines = explode(PHP_EOL, $method->getDocComment());
            $debug = [];
            $presenter = array_filter(array_map(function ($line) use (&$debug) {
                $line = ltrim(ltrim(trim($line), '*'));
                if (strtolower(substr($line, 0, strlen(self::ANNOTATION))) !== self::ANNOTATION) {
                    return false;
                }
                $class = trim(substr($line, strlen(self::ANNOTATION)));
                if (!class_exists($class)) {
                    return false;
                }
                return $class;
            }, $lines));

            if ($presenter) {
                $result = \App::make(array_shift($presenter));
            }
        }

        return $result;
    }
}