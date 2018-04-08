<?php
/**
 * @author Wu Lihua <wu.lihua@immomo.com>
 * @since  2018-04-08
 */
/**
 * @ Microsoft
 * @ Link: https://www.dailycodingproblem.com/blog/longest-increasing-subsequence/
 * @ 时间复杂度: O(n^2)
 *
 */
function longest_increasing_subsequence($arr){
    if (empty($arr)) {
        return 0;
    }

    $arr_len = count($arr);
    $cache = array_fill(0, $arr_len, 1);

    for ($i = 1; $i < $arr_len; $i ++) {
        for ($k = 0; $k < $i; $k ++) {
            if ($arr[$i] > $arr[$k]) {
                $cache[$i] = max($cache[$i], $cache[$k] + 1);
            }
        }
    }

    return max($cache);
}

$arr = [0, 8, 4, 12, 2, 10, 6, 14, 1, 9, 5, 13, 3, 11, 7, 15];
var_dump(longest_increasing_subsequence($arr));