<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-5-13
 * Time: 下午9:29
 * To change this template use File | Settings | File Templates.
 */

namespace Calendar\Model;

class LeapYear {
    public function isLeapYear($year = null)
    {
        if(null === $year)
        {
            $year = date('Y');
        }
        return 0 == $year % 400 || ( 0 == $year % 4 && 0 != $year % 100);
    }
}