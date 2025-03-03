@extends('layouts.main')

@section('title', 'Posts')
@section('posts_count', count($posts))

@section('content')
    <div class="p-6 min-h-screen">
        {{-- Create Button --}}
        <div class="flex justify-end mb-4">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="bg-green-900/30 hover:bg-green-900/50 text-yellow-400 hover:text-yellow-500  font-medium text-xs px-4 py-2 rounded-lg shadow-sm"
                type="button">
                Create post
            </button>

            {{-- Modal --}}
            <x-modal :id="'crud-modal'" />
        </div>

        {{-- Table --}}
        <table class="min-w-full text-gray-300 border border-gray-800 rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-indigo-400">
                <tr class="rounded-t-lg">
                    <th class="py-3 px-6 text-left border-b border-gray-700">Title</th>
                    <th class="py-3 px-6 text-left border-b border-gray-700">Category</th>
                    <th class="py-3 px-6 text-left border-b border-gray-700">Views</th>
                    <th class="py-3 px-6 text-center border-b border-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr
                        class="{{ $loop->even ? 'bg-gray-800' : 'bg-gray-900' }} border-b border-gray-700 last:rounded-b-lg">
                        <td class="py-3 px-6">{{ $post['title'] }}</td>
                        <td class="py-3 px-6">{{ $post['category_name'] }}</td>
                        <td class="py-3 px-6">{{ $post['view_count'] }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center space-x-3">
                                <a href="{{ route('posts.update') }}"
                                    class="bg-indigo-900/30 text-indigo-400 hover:bg-indigo-900/50 hover:text-indigo-700 font-medium text-xs px-4 py-1 rounded-lg shadow-sm">
                                    Edit
                                </a>
                                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                    class="bg-indigo-900/30 text-indigo-400 hover:bg-indigo-900/50 hover:text-indigo-700 font-medium text-xs px-4 py-1 rounded-lg shadow-sm">
                                    Edit
                                </button>
                                <form action="{{ route('posts.destroy', $post['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-900/50 text-red-400 hover:bg-red-900/70 hover:text-red-500 font-medium text-xs px-4 py-1 rounded-lg shadow-sm"
                                        onclick="return confirm('Are you sure you want to delete this post?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
