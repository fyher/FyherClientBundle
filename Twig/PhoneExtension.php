<?php

namespace Fyher\ClientBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PhoneExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('phoneFyher', array($this, 'photoFyherFilter')),
        );
    }

    public function photoFyherFilter($number,$truncateZero= true)
    {
        if($truncateZero){
            $number=substr($number,1);
        }


        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $number=$phoneNumberUtil->parse($number,"FR");

        // $number=$phoneNumberUtil>getAsYouTypeFormatter('Fr');;

        if($truncateZero){
            return  $phoneNumberUtil->format($number, \libphonenumber\PhoneNumberFormat::E164);
        }else{
            return  $phoneNumberUtil->format($number, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
        }


    }
}