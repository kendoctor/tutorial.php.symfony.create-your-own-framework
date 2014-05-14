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
            $response =  new Response(sprintf('Yep, %d, this is a leap year!'.rand(), $year));
        }else
        {
            //allows to return a string now.
            return  sprintf('Nope, %d, this is not a leap year!', $year);
        }

        $response->setTtl(10);

        /*
         $date = date_create_from_format('Y-m-d H:i:s', '2005-10-15 10:00:00');

           $response->setCache(array(
               'public'        => true,
               'etag'          => 'abcde',
               'last_modified' => $date,
               'max_age'       => 10,
               's_maxage'      => 10,
           ));

           // it is equivalent to the following code
           $response->setPublic();
           $response->setEtag('abcde');
           $response->setLastModified($date);
           $response->setMaxAge(10);
           $response->setSharedMaxAge(10);

        */

        return $response;
    }
}