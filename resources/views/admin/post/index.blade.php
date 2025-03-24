@extends('layouts.main')

@section('title', 'Posts')
@section('posts_count', count($posts))

@section('content')
    {{-- Create Button --}}
    <div class="flex flex-col sm:flex-row justify-between mb-4">
        <a href="{{ route('posts.trashed') }}"
            class="mb-2 sm:mb-0 bg-red-900/30 hover:bg-red-900/50 text-red-400 hover:text-red-500 font-medium text-xs px-4 py-2 rounded-lg shadow-sm text-center"
            type="button">
            Deleted post
        </a>
        <button id="create-btn" data-modal-target="modal-create" data-modal-toggle="modal-create"
            class="bg-green-900/30 hover:bg-green-900/50 text-yellow-400 hover:text-yellow-500 font-medium text-xs px-4 py-2 rounded-lg shadow-sm"
            type="button">
            Create post
        </button>
    </div>

    {{-- Modal --}}
    <x-modal id="modal-create" title="Create Post" route="{{ route('posts.store') }}" method="POST" buttonText="Create" />
    <x-modal id="modal-update" title="Update Post" route="{{ route('posts.update') }}" method="PUT" buttonText="Update" />

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-gray-300 border border-gray-800 rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-indigo-400">
                <tr>
                    <th class="py-3 px-6 text-left border-b border-gray-700">Title</th>
                    <th class="py-3 px-6 text-left border-b border-gray-700">Category</th>
                    <th class="py-3 px-6 text-left border-b border-gray-700">Views</th>
                    <th class="py-3 px-6 text-center border-b border-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="{{ $loop->even ? 'bg-gray-800' : 'bg-gray-900' }} border-b border-gray-700">
                        <td class="py-3 px-6">{{ $post->title }}</td>
                        <td class="py-3 px-6">{{ $post->category_name }}</td>
                        <td class="py-3 px-6">{{ $post->views }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center space-x-3">
                                <button id="update-btn" data-modal-target="modal-update" data-modal-toggle="modal-update"
                                    data-post-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                    data-category="{{ $post->category_name }}" data-body="{{ $post->body }}"
                                    class="bg-indigo-900/30 text-indigo-400 hover:bg-indigo-900/50 hover:text-indigo-700 font-medium text-xs px-4 py-1 rounded-lg shadow-sm">
                                    Edit
                                </button>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-900/50 text-red-400 hover:bg-red-900/70 hover:text-red-500 font-medium text-xs px-4 py-2 rounded-lg shadow-sm"
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

    <div class="flex justify-end">
        <x-pagination :pagination="$pagination" />
    </div>

<script>
        document.addEventListener('DOMContentLoaded', () => {
            const updateButtons = document.querySelectorAll('#update-btn');

            updateButtons.forEach(updateButton => {
                updateButton.addEventListener('click', () => {
                    const id = updateButton.getAttribute('data-post-id');
                    const title = updateButton.getAttribute('data-title');
                    const category = updateButton.getAttribute('data-category');
                    const body = updateButton.getAttribute('data-body');

                    document.querySelector('#modal-update input[name="id"]').value = id;
                    document.querySelector('#modal-update input[name="title"]').value = title;
                    document.querySelector('#modal-update input[name="category_name"]').value =
                        category;
                    document.querySelector('#modal-update textarea[name="body"]').value = body;
                });
            });
        });
    </script>
@endsection
