<?php
class Validate 
{
    public static function isNumber($number, $min = 0, $max = 100): bool
    {
        return ($number >= $min and $number <= $max);
    } 

    public static function isText(string $string, int $min = 0, int $max = 1000): bool
    {
        $length = mb_strlen($string);
        return ($length >= $min and $length <= $max);
    }

    public static function isMemberId($member_id, array $member_list): bool
    {
        foreach ($member_list as $member) {
            if ($member['id'] == $member_id) {
                return true;
            }
        }
        return false;
    }

    public static function isCategoryId($category_id, array $category_list): bool
    {
        foreach ($category_list as $category) {
            if ($category['id'] == $category_id) {
                return true;
            }
        }
        return false;
    }

}