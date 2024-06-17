<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Damh mục sản phẩm
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-4">
            <form action="{{ route('dashboard') }}" method="GET">
                <div class="flex">
                    <div class="mr-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category:</label>
                        <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Search:</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="ml-4 mt-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($tasks as $task)
    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        @if ($task->image)
            <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->name }}" class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                No Image
            </div>
        @endif
        <div class="px-6 py-4">
            <div class="font-semibold text-xl mb-2">{{ $task->name }}</div>
            <p class="text-gray-700">{{ $task->description }}</p>
            <p class="text-gray-900 font-semibold mt-2">${{ $task->price }}</p>
        </div>
        <div class="px-6 py-4">
        <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="addToCart({{ $task->id }})">+ Thêm vào giỏ hàng</button>
        </div>
    </div>
@endforeach
        </div>
    </div>
    <div class="mt-6">
            {{ $tasks->appends(request()->except('page'))->links() }}
        </div>
    </div>
</x-app-layout>
<script>
    function addToCart(taskId) {
        axios.post('/add-to-cart', {
            task_id: taskId
        })
        .then(function (response) {
            alert('Thêm sản phẩm vào giỏ hàng thành công!');
        })
        .catch(function (error) {
            console.error('Lỗi khi thêm sản phẩm vào giỏ hàng:', error);
        });
    }
</script>

