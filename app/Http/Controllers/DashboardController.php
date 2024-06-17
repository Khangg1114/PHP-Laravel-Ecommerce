<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index(Request $request)
    {


        $tasksQuery = Task::query();

        // Lọc theo category_id nếu có
        if ($request->filled('category_id')) {
            $tasksQuery->where('category_id', $request->input('category_id'));
        }

        // Tìm kiếm theo tên nếu có
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $tasksQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Lấy danh sách các category để hiển thị trong dropdown
        $categories = Category::all();

        // Lấy danh sách tasks đã lọc và tìm kiếm
        $tasks = $tasksQuery->get();
        $tasks = $tasksQuery->paginate(9); 

        return view('dashboards.index', compact('tasks', 'categories'));
    }
}
