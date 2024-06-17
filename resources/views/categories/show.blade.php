<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show Category
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <a href="{{ route('categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to List</a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Category Details</h3>
                    <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-900">Edit Category</a>
                </div>

                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-600">ID:</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $category->id }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-600">Name:</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $category->name }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
