<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Adminlər üçün autentifikasiya middleware-i
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // Admin dashboard səhifəsi
        return view('admin.html.dashboard.index');
    }
}
