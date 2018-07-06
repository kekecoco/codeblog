<?php
/**
 * @author Wu Lihua <wu.lihua@immomo.com>
 * @since  2018-07-06
 */

/**
 * 括号匹配
 *
 * @param $str
 * @return bool
 */
function bracketsMatch($str) {
    if (empty($str)) {
        return false;
    }
    $brackets_map = [
        ')' => '(',
        ']' => '{',
        '}' => '{',
    ];
    $stack = [];
    for ($i = 0, $len = strlen($str); $i < $len; $i ++) {
        if (in_array($str[$i], array_values($brackets_map))) {
            array_push($stack, $str[$i]);
        } elseif (in_array($str[$i], array_keys($brackets_map))) {
            if (!empty($stack) && $brackets_map[$str[$i]] == end($stack)) {
                array_shift($stack);
            } else {
                return false;
            }
        }
    }
    if (empty($stack)) {
        return true;
    } else {
        return false;
    }
}

