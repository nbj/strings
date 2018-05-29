<?php

namespace Nbj;

class Str
{
    /**
     * Holds all previously converted results to save cpu cycles
     *
     * @var array $cachedSnakeCaseResults
     */
    protected static $cachedSnakeCaseResults = [];

    /**
     * Holds all previously converted results to save cpu cycles
     *
     * @var array $cachedCamelCaseResults
     */
    protected static $cachedCamelCaseResults = [];

    /**
     * Converts a string to lowercase
     *
     * @param string $string
     *
     * @return string
     */
    public static function toLower($string)
    {
        return mb_strtolower($string, 'UTF-8');
    }

    /**
     * Converts a string to uppercase
     *
     * @param string $string
     *
     * @return string
     */
    public static function toUpper($string)
    {
        return mb_strtoupper($string, 'UTF-8');
    }

    /**
     * Gets the length of a string
     *
     * @param string $string
     *
     * @return int
     */
    public static function length($string)
    {
        return mb_strlen($string, 'UTF-8');
    }

    /**
     * Converts a string to snake_case
     *
     * @param string $string
     * @param string $delimiter
     *
     * @return string
     */
    public static function toSnake($string, $delimiter = '_')
    {
        $key = $string;

        // Check if we have the word in the cache already
        if (isset(static::$cachedSnakeCaseResults[$key][$delimiter])) {
            return static::$cachedSnakeCaseResults[$key][$delimiter];
        }

        // If all characters are not lowercase we convert it
        if (!ctype_lower($string)) {
            $string = preg_replace('/\s+/u', '', ucwords($string));
            $string = static::toLower(preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $string));
        }

        // Store the converted word in the snake case cache
        return static::$cachedSnakeCaseResults[$key][$delimiter] = $string;
    }

    /**
     * Converts a string to kebab-case
     *
     * @param string $string
     *
     * @return string
     */
    public static function toKebab($string)
    {
        return static::toSnake($string, '-');
    }

    /**
     * Converts a string to camel case
     *
     * @param string $string
     *
     * @return string
     */
    public static function toCamel($string)
    {
        $key = $string;

        // Check if we have the word in the cache already
        if (isset(static::$cachedCamelCaseResults[$key])) {
            return static::$cachedCamelCaseResults[$key];
        }

        $string = ucwords(preg_replace('/(_|-)/u', ' ', $string));
        $string = lcfirst(str_replace(' ', '', $string));

        return static::$cachedCamelCaseResults[$key] = $string;
    }

    /**
     * Converts a string to Pascal case
     *
     * @param string $string
     *
     * @return string
     */
    public static function toPascal($string)
    {
        return ucfirst(self::toCamel($string));
    }

    /**
     * Checks if a string starts with another string
     *
     * @param string $search
     * @param string $string
     *
     * @return bool
     */
    public static function startWith($search, $string)
    {
        $pattern = sprintf('/^%s/', $search);

        return (bool) preg_match($pattern, $string);
    }

    /**
     * Checks if a string ends with another string
     *
     * @param string $search
     * @param string $string
     *
     * @return bool
     */
    public static function endsWith($search, $string)
    {
        $pattern = sprintf('/%s$/', $search);

        return (bool) preg_match($pattern, $string);
    }

    /**
     * Checks if a string contains another string
     *
     * @param string $search
     * @param string $string
     *
     * @return bool
     */
    public static function contains($search, $string)
    {
        return (bool) strpos($string, $search);
    }

    /**
     * Gets a subset of a given string
     *
     * @param string $string
     * @param int $start
     * @param int|null $length
     *
     * @return string
     */
    public static function sub($string, $start = 0, $length = null)
    {
        if ($length == null) {
            $length = strlen($string);
        }

        return substr($string, $start, $length);
    }
}
