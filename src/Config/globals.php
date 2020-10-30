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