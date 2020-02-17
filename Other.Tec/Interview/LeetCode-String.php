<?php
/**
 * Created by PhpStorm.
 * User: Wu Lihua <maikekechn@gmail.com>
 * Time: 2020/2/17 3:05 PM
 */
/**
 * 给一串字符串,求其最长的子串
 *
 */
function getMaxLengthSubString($subjectString) {
	$length = mb_strlen($subjectString, "utf-8");
	if ($length <= 0) {
		return 0;
	}
	$maxLength = 0;
	$containArr = [];
	for ($i = 0,$j = 0; $j < $length; $j ++) {
		if (!empty($containArr[$subjectString[$j]])) {
			$i = max($containArr[$subjectString[$j]], $i);
		}
		$maxLength = max($maxLength, $j - $i + 1);
		$containArr[$subjectString[$j]] = $j + 1;
	}
	return $maxLength;
}
$str = "abcabcbb";
var_dump(getMaxLengthSubString($str));

/**
 * 给定一个只包括"(",")"的字符串,判断字符串是否有效.注: 空字符串是有效字符串
 *
 */
function isStringValid($subjectString) {
	if (mb_strlen($subjectString) < 1) {
		return true;
	}
	$subjectStrLen = mb_strlen($subjectString);
	$stack = [];
	for ($i = 0; $i < $subjectStrLen; $i ++) {
		$char = $subjectString[$i];
		if ($char == "(") {
			array_push($stack, $char);
		} else {
			if (empty($stack)) {
				return false;
			} else {
				array_pop($stack);
			}
		}
	}
	if (empty($stack)) {
		return true;
	}
	return false;
}
$str2 = "(())(";
var_dump(isStringValid($str2));
