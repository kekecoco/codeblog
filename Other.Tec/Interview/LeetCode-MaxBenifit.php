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
function getMaxBenefit($arr) {
	if (empty($arr)) {
		return [];
	}
	$arr_len = count($arr);
	if ($arr_len < 2) {
		return [];
	}
	$price_min = $arr[0];
	$max_benefit = 0;
	for ($i = 1; $i < $arr_len; $i ++) {
		if ($arr[$i] < $price_min) {
			$price_min = $arr[$i];
			continue;
		} else {
			$currentBenefit = $arr[$i] - $price_min;
			if ($currentBenefit > $max_benefit) {
				$max_benefit = $currentBenefit;
			}
		}
	}
	return $max_benefit;
}

$arr = [1, 1.2, 2, 4, 5, 1, 9];
$res = getMaxBenefit($arr);
var_dump($res);