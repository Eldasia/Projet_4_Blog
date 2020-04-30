<?php

namespace MaureenBruihier\Projet4\controller\Admin;

use \MaureenBruihier\Projet4\lib\View;

class AdminController extends Controller
{
    public function dashboard()
    {
        return View::make('admin/dashboard', [
            'title' => 'Interface administrateur',
        ]);
    }
}