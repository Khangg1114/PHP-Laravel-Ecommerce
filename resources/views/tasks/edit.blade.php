<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Task
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                        <input type="text" name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('description', $task->description) }}" />
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <label for="name" class="block font-medium text-sm text-gray-700 mt-4">Name</label>
                        <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('name', $task->name) }}" />
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <label for="price" class="block font-medium text-sm text-gray-700 mt-4">Price</label>
                        <input type="text" name="price" id="price" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('price', $task->price) }}" />
                        @error('price')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <label for="category_id" class="block font-medium text-sm text-gray-700 mt-4">Category</label>
                        <select name="category_id" id="category_id" class="form-select rounded-md shadow-sm mt-1 block w-full">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $task->category_id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <label for="image" class="block font-medium text-sm text-gray-700 mt-4">Image</label>
                        <input type="file" name="image" id="image" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        @error('image')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
