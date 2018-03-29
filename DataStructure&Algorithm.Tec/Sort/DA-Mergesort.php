<?php
/**
 * @author Wu Lihua <wu.lihua@immomo.com>
 * @since  2018-03-29
 */

/**
 * 归并排序
 * 时间复杂度: O(nlogn)
 */

function mergeSort($sort_arr) {

    $len = count($sort_arr);
    if ($len <= 1) {
        return $sort_arr;
    }

    // 切分数组
    $middle     = intval($len / 2);
    $top_arr    = array_slice($sort_arr, 0, $middle);
    $bottom_arr = array_slice($sort_arr, $middle);

    $top_arr    = mergeSort($top_arr);
    $bottom_arr = mergeSort($bottom_arr);

    $new_arr = [];
    while ($top_arr && $bottom_arr) {
        if ($top_arr[0] < $bottom_arr[0]) {
            $new_arr[] = array_shift($top_arr);
        } else {
            $new_arr[] = array_shift($bottom_arr);
        }
    }

    return array_merge($new_arr, $top_arr, $bottom_arr);
}

$sort_arr = [21, 34, 3, 32, 82, 55, 89, 50, 37, 5, 64, 35, 9, 70];
print_r(mergeSort($sort_arr));
