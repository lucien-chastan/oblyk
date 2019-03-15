<?php

namespace App\Lib;

class Grade
{
    public static function isGrade($grade, $authorize_empty = false)
    {
        return (preg_match(
            '/^((([1-9][abc]?)|(B[0-9]|B1[0-6])|(E[0-9]|E1[0-1])|(PD|AD|D|TD|ED|ABO)|([I]{1,3}|IV|V[III]{0,3}|IX|X[III]{0,3})|(M|D|VD|S|HS|VS|HVS)|(VB|V[0-9]|V1[0-9]|V20)|(A[0-6])|(5\.[0-9]|5\.1[0-5][abcd]))(\+|\-|\/\-|\/\+|\?|\+\/\?|\-\/\?|\+\/b|\+\/c)?|\?)$/',
            $grade
        ) || ($grade === '' && $authorize_empty));
    }
}
