<?php

namespace MaureenBruihier\Projet4\controller\Admin;

class AdminController extends Controller
{
    public function dashboard()
    {
        require('views/admin/dashboard.php');
    }
}