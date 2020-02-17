<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2020/2/17 5:33 PM
 */
/**
 * 编写一个搞笑的算法来搜索m*n矩阵中的一个目标值target.该矩阵具有以下特性:
 * 每行的元素从左到右升序排列.
 * 每列的元素从上到下升序排列.
 */
function searchMatrix($arr, $target) {
	$row = count($arr) - 1;
	$column = 0;
	while ($row >= 0 && $column < count($arr[0])) {
		if ($arr[$row][$column] == $target) {
			return true;
		} elseif ($arr[$row][$column] > $target) {
			$row--;
		} else {
			$column++;
		}
	}
	return false;
}

$arr = [[1,2,3],[4,5,6],[7,8,9]];
var_dump(searchMatrix($arr, 0));

