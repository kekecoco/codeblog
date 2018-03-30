<?php
/**
 * @author Wu Lihua <wu.lihua@immomo.com>
 * @since  2018-03-30
 */

/**
 * @字节跳动&滴滴
 * @Given two sorted integer arrays nums1 and nums2, merge nums2 into nums1 as one sorted array.
 * 时间复杂度: O(M+N)
 */
function mergeSortedArray($a, $b){
    $a_len = count($a);
    $b_len = count($b);

    $i = 0;
    $j = 0;
    $k = 0;
    $result = [];
    while ($i < $a_len && $j < $b_len) {
        if ($a[$i] <= $b[$j]) {
            $result[$k++] = $a[$i++];
        } else {
            $result[$k++] = $b[$j++];
        }
    }
    while ($i < $a_len) {
        $result[$k++] = $a[$i++];
    }
    while ($j < $b_len) {
        $result[$k++] = $b[$j++];
    }
    return $result;
}

$a = [1,2,3,4,5,6];
$b = [5,6,7,8,9,10];

print_r(mergeSortedArray($a, $b));
