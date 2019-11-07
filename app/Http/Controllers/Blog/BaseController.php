<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Базовый контроллер для всех контроллеров управления
 * блогом в панели администрирования.
 *
 * Должен быть родителем всех контроллеров управления блогом.
 *
 * @package App\Http\Controllers\Blog
 */
abstract class BaseController extends Controller
{
    /**
     * BaseController constructor.
     */
    public function  __construct()
    {

    }
}
