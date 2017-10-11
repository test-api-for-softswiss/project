<?php
/**
 * Author: Anton Orlov
 * Date: 10.10.2017
 * Time: 23:31
 */

namespace App\Presenters;


interface PresenterInterface
{
    public function getResponse($object);
}