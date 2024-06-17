<!-- resources/views/home.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Home Page
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <h3 class="text-lg font-semibold mb-4">List of Tasks</h3>

            @if ($tasks->isEmpty())
                <p>No tasks available.</p>
            @else
                <ul>
                    @foreach ($tasks as $task)
                        <li>
                            <strong>Task Name:</strong> {{ $task->name }} <br>
                            <strong>Description:</strong> {{ $task->description }} <br>
                            <strong>Price:</strong> ${{ $task->price }}
                            <!-- Hiển thị thêm thông tin task cần thiết -->
                        </li>
                        <hr>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
