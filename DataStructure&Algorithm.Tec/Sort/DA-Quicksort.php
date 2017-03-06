<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2016/11/5 下午5:37
 */

/**
 * 名称：快速排序
 * 时间复杂度：O(nlogn)~O(n^2)
 * 空间复杂度：O(logn)~O(n)(原)
 * 稳定性：不稳定
 */
function Quicksort($arr) {

	$len = count($arr);
	if ($len <= 1) {
		return $arr;
	}

	$leftArr = $rightArr = [];
	$middleItem = $arr[0];

	for ($i = 1; $i < $len; $i++) {
		if ($arr[$i] < $middleItem) {
			$leftArr[]  = $arr[$i];
		} else {
			$rightArr[] = $arr[$i];
		}
	}

	return array_merge(Quicksort($leftArr), (array)$middleItem, Quicksort($rightArr));
}


