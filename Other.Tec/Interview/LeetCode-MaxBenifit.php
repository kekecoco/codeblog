<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2018/8/8 下午9:43
 */
/**
 * 给你一个股价序列，告诉你每个时间点的股价，问你什么时候买什么时候卖获利最大。时间复杂度越低越好。
 * 时间复杂度: O(N)
 */
function getMaxBenifit($arr) {
	if (empty($arr)) {
		return [];
	}
	$arr_len = count($arr);
	if ($arr_len < 2) {
		return [];
	}
	$price_min = min($arr[0], $arr[1]);
	$max_benifit = $arr[1] - $arr[0];
	for ($i = 2; $i < $arr_len; $i ++) {
		if ($arr[$i] - $price_min > $max_benifit) {
			$max_benifit = $arr[$i] - $price_min;
		}
		if ($arr[$i] < $price_min) {
			$price_min = $arr[$i];
		}
	}

	return $max_benifit;
}

$arr = [1, 1.2, 2, 4, 5, 1, 9];
$res = getMaxBenifit($arr);
var_dump($res);