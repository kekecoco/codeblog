<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2016/10/18 下午5:11
 */

/**
 * 名称:二分法数据查找(Binary Search)
 * 时间复杂度:O(log(n))
 */
function binarySearch(array $searchArr, $searchNum) {
	if (!is_array($searchArr) || empty($searchArr)) {
		return false;
	} else {
		sort($searchArr);
	}

	if (!isset($searchNum) || $searchNum == '') {
		return false;
	}

	$top    = 0;
	$bottom = count($searchArr) - 1;
	while ($top <= $bottom) {
		$middle = intval(($top + $bottom)/2);
		if ($searchNum == $searchArr[$middle]) {
			return $middle;
		} elseif ($searchNum < $searchArr[$middle]) {
			$bottom = $middle - 1;
		} else {
			$top = $middle + 1;
		}
	}
	return false;
}