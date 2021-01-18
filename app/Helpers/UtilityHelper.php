<?php

namespace App\Helpers;

class UtilityHelper
{
    public static function getCurrency()
    {
        return 'KWD';
    }

    public static function renderImage($image)
    {
        if(!is_null($image))
        {
            return url($image);
        }else{
            return url('img/dummy.jpg');
        }
    }

//    public static function getCourses()
//    {
//        $customer = Customer::with(['courses'])->where()->first();
//
//        if(!is_null($customer) && !is_null($customer->courses)){
//
//            $courses = $customer->courses->pluck('course_id')->toArray();
//
//            return sizeof($courses) > 0 ? $courses : [];
//        }
//
//        return [];
//    }

}
