<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2017/2/23 下午2:14
 */
/**
 * 名称：冒泡排序
 * 平均时间复杂度：O(n^2)
 */
function Bubble ($sortArr) {

	$flag = true;

	$index = count($sortArr)-1;

	while ($flag) {
		$flag = false;
		for ($i = 0; $i < $index; $i++) {
			if ($sortArr[$i] > $sortArr[$i+1]) {
				$flag = true;
				$last = $i;
				$temp = $sortArr[$i];
				$sortArr[$i] = $sortArr[$i+1];
				$sortArr[$i+1] = $temp;
			}
		}
		if (isset($last)) {
			$index = $last;
		}
	}

	return $sortArr;
}

$sortArr = [2,1,5,6,8,3,4];
var_dump(Bubble($sortArr));