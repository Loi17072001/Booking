<?php
/**
 * File LaravelController.php
 *
 * @author HaiDT
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers;

/**
 * Class LaravueController
 *
 * @package App\Http\Controllers
 */
class LaravueController extends Controller
{
    /**
     * Entry point for Laravue Dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin');
    }

    public function booking()
    {
        return view('client');
    }
}
