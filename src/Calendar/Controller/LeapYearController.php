<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Date: 14-5-13
 * Time: 下午9:29
 * To change this template use File | Settings | File Templates.
 */
namespace Calendar\Controller;

use Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Response;


class LeapYearController {
    public function indexAction($year)
    {
        $leapYear = new LeapYear();
        if($leapYear->isLeapYear($year))
        {
            return new Response(sprintf('Yep, %d, this is a leap year!', $year));
        }
        return new Response(sprintf('Nope, %d, this is not a leap year!', $year));
    }
}