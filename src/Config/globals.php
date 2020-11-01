<?php

/**
 * joins tokens making a path according to the DS value
 *
 * @param array $tokens
 * @return string
 */
function pathJoin(array $tokens)
{
    return implode(DS, $tokens);
}

/**
 * returns the root directory path
 *
 * @return string
 */
function rootDir()
{
    return realpath( 
        pathJoin( [__DIR__, '..', '..'] )
    );
}

/**
 * logs the message into the logging file
 *
 * @param array ...$args - message and level of logging
 * @return void
 */
function g_log(...$args)
{
    \call_user_func_array(
        ['Propel\\Runtime\\Propel', 'log'],
        $args
    );
}