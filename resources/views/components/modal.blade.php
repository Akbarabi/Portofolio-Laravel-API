@props(['id', 'title' => 'Modal Title', 'route', 'method' => 'POST', 'buttonText' => 'Save'])

<div id="{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 min-h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto bg-gray-900 rounded-2xl">
        {{-- Button --}}
        <div
            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="{{ $id }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close</span>
            </button>
        </div>
        {{-- Form --}}
        <form id="modal-form" class="px-4 md:px-5 pt-5 pb-3" action="{{ route('posts.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            {{ csrf_field() }}
            @if ($method !== 'POST')
                @method($method)
            @endif

            <input type="hidden" id="id" name="id">

            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="photo" />
                    <input type="file" name="photo" id="photo" value="{{ old('photo') }}"
                        class="text-gray-400 rounded-lg dark:bg-gray-600 w-full" />
                </div>
                <div class="col-span-2">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="What's your post title?" required="true">
                </div>
                <div class="col-span-2">
                    <label for="category_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <input type="text" name="category_name" id="category_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Enter category name" required="true">
                </div>
                <div class="col-span-2">
                    <label for="body"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
                    <div id="quill-editor"
                        class="block p-2.5 w-full text-sm text-gray-900 rounded-b-lg dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white h-full">
                    </div>
                    <textarea id="body" name="body" rows="4" class="hidden"></textarea>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-20 z-50">
                    <x-mdi-plus />
                    {{ $buttonText }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.ql-editor {
    height: 150px; /* Your desired height */
    overflow-y: visible; /* Only show scrollbar when actually needed */
    min-height: 150px;
}
    .ql-toolbar {
        background-color: #2d3748; /* Dark background for toolbar */
        border-radius: 8px 8px 0 0;
        border: none;
    }
</style>

<script src="{{ asset('js/ToolbarOptions.js') }}"></script>

<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        if (!window.quillInitialized) {
            const quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: toolbarOptions
                }
            });

            const form = document.getElementById('modal-form');
            form.onsubmit = function() {
                const body = document.querySelector('textarea[name=body]');
                body.value = quill.root.innerHTML;
            };

            window.quillInitialized = true;
        }
    });
</script>
