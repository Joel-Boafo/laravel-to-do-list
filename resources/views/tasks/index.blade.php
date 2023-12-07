<x-app-layout>
    <div class="w-10/12 bg-white font-semibold rounded-sm mx-auto mt-10 border py-3">
        <h1 class="mt-8 text-xl font-bold ml-[66px]">Todo List</h1>
        <br>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="flex items-center">
                <input class="ml-16 w-10/12 px-2 py-2 border rounded-md shadow-md border-gray-400 focus:border-gray-400 focus:outline-none" type="text" name="description" id="description" placeholder="Add a new task">
                <a href="#"><button class="border rounded-sm bg-blue-500 text-xl font-bold text-white px-4 py-2 ml-2">+</button></a>
            </div>
        </form>
        <br>
        <div class="w-11/12 mx-auto">
            @foreach ($tasks as $task)
            <div class="flex border bg-gray-200 mt-2 py-2 w-full justify-between items-center">
                <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                    @csrf
                    <label class="">
                        <input class="ml-4" type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }}>
                        <span class="ml-2 text-lg {{ $task->is_completed ? 'line-through text-gray-400' : '' }}">{{ $task->description }}</span>
                    </label>
                </form>
                <div class="flex">
                    <form action="{{ route('tasks.edit', $task->id) }}" method="GET">
                        @csrf
                        <button type="submit" class="text-white rounded-lg ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                          </svg>
                          </button>
                    </form>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                          </svg>
                          </button>
                    </form>
                </div>
            </div>
            @endforeach
            <form action="{{ route('tasks.clear-completed') }}" method="post">
                @csrf
                <button class="bg-blue-600 px-6 py-2 text-white rounded-md mt-3">Clear Completed</button>
            </form>
            <div class="w-full">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
