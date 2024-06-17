<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TasksController extends Controller
{
    public function index()
    {
        
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(StoreTaskRequest $request)
    {
         // Validate dữ liệu gửi từ request
        $validatedData = $request->validated();

        // Tạo một đối tượng Task mới và gán các giá trị từ request vào
        $task = new Task();
        $task->description = $request->input('description');
        $task->name = $request->input('name');
        $task->price = $request->input('price');
        $task->category_id = $request->input('category_id');

        // Xử lý file ảnh nếu được gửi lên
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $task->image = str_replace('public/', '', $imagePath); // Lưu đường dẫn sau khi loại bỏ 'public/'
        }

        // Lưu đối tượng Task vào cơ sở dữ liệu
        $task->save();

        // Redirect về trang danh sách tasks sau khi tạo thành công
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    { 
        // Validate dữ liệu gửi từ request
        $validatedData = $request->validated();

        // Gán các giá trị từ request vào đối tượng Task
        $task->description = $request->input('description');
        $task->name = $request->input('name');
        $task->price = $request->input('price');
        $task->category_id = $request->input('category_id');

        // Xử lý file ảnh nếu được gửi lên
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $task->image = str_replace('public/', '', $imagePath); // Lưu đường dẫn sau khi loại bỏ 'public/'
        }

        // Lưu các thay đổi vào cơ sở dữ liệu
        $task->save();

        // Redirect về trang hiển thị task sau khi cập nhật thành công
        return redirect()->route('tasks.show', $task->id)->with('success', 'Task updated successfully.');
        }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
