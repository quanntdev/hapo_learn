<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class AjaxController extends Controller
{
    public function search()
    {
        $key = $_GET['key'];
        $courses = Course::outputSearchData($key);
        return $courses;
    }
}
