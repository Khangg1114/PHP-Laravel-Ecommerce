<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
       // Lấy danh sách các task từ cơ sở dữ liệu
       $tasks = Task::all();

       // Truyền danh sách tasks vào view 'home' để hiển thị trên trang chủ
       return view('home', compact('tasks'));
    }

}
