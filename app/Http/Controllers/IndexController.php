<?php
/**
 * Author: Anton Orlov
 * Date: 09.10.2017
 * Time: 23:31
 */

namespace App\Http\Controllers;


class IndexController
{
    public function indexAction()
    {
        return view('welcome');
    }
}