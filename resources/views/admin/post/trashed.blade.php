<!-- filepath: d:\Code\portofolio+post\portofolio-api\resources\views\admin\post\trashed.blade.php -->
@extends('layouts.main')

@section('title', 'Trashed Posts')

@section('content')
    <div class="mb-4">
        <a href="{{ route('posts.index') }}"
            class="bg-indigo-900/30 text-indigo-400 hover:bg-indigo-900/50 hover:text-indigo-700 font-medium text-xs px-4 py-1 rounded-lg shadow-sm">
            Back to Post
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($posts as $post)
            <div
                class="flex flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <img class="object-cover border-r-current {{ $post->photo ? 'shadow-md' : '' }} rounded-t-lg h-40 w-full" src="{{ $post->photo }}"
                    alt="{{ $post->title }}">
                <div class="flex flex-col justify-center items-start p-4">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ Str::limit($post->title, 30) }}
                    </h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($post->body, 30) }}</p>
                    <div class="flex gap-2 w-full">
                        <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="w-1/2">
                            @csrf
                            @method('POST')
                            <button type="submit" id="restore-btn"
                                class="bg-green-900/30 hover:bg-green-900/50 text-yellow-400 hover:text-yellow-500 font-medium text-xs pxpo-4 py-2 rounded-lg shadow-sm w-full">
                                Restore
                            </button>
                        </form>

                        <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" class="w-1/2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-btn"
                                class="bg-red-900/30 hover:bg-red-900/50 text-red-400 hover:text-red-500 font-medium text-xs px-4 py-2 rounded-lg shadow-sm w-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
