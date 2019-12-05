<?php
/**
 * helper.php
 * In twig: {{ helper.model('catalog/product').getProduct(28).name }}
 * Others:  model('catalog/product')->getProduct(28)
 *
 * @copyright  2017 opencart.cn - All Rights Reserved
 * @link       http://www.guangdawangluo.com
 * @author     Edward Yang <yangjin@opencart.cn>
 * @created    2017-11-29 10:52
 * @modified   2017-11-29 10:52
 */

namespace Utils;

class Helper
{
    private static $helper;

    public static function getSingleton()
    {
        if (self::$helper instanceOf Helper) {
            return self::$helper;
        } else {
            return self::$helper = new Helper;
        }
    }
    public function __call($name, $arguments)
    {
        $name = snake_case($name);
        if (!function_exists($name)) {
            throw new \Exception("The function {$name} is not exist!");
        }
        return call_user_func($name, $arguments);
    }

    public function sub_string($string, $length, $dot = '...')
    {
        return sub_string($string, $length, $dot);
    }

    public function config($key, $default = null)
    {
        return config($key, $default);
    }

    public function format_date($format, $timestamp = null)
    {
        return format_date($format, $timestamp);
    }

    public function image_resize($image = 'placeholder.png', $width = 100, $height = 100)
    {
        return image_resize($image, $width, $height);
    }


    public function old($key, $default = null)
    {
        return old($key, $default);
    }

    public function model($route)
    {
        return model($route);
    }

    public function template($route)
    {
        if (config('config_theme') == 'default') {
            if (is_file(DIR_TEMPLATE . config('theme_default_directory') . "/template/{$route}.twig")) {
                return config('theme_default_directory') . "/template/{$route}.twig";
            }
        }

        if (is_file(DIR_TEMPLATE . config('config_theme') . "/template/{$route}.twig")) {
            return config('config_theme') . "/template/{$route}.twig";
        }
        return "default/template/{$route}.twig";
    }
}
