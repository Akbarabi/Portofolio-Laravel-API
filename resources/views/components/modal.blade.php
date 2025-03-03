@props(['id', 'post', 'route', 'method'])

<div id={{ $id }} tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 min-h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto bg-gray-900 rounded-2xl">
        {{-- Button --}}
        <div
            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Create Post
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="crud-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close</span>
            </button>
        </div>
        {{-- Form --}}
        <form class="p-4 md:p-5" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" id="id">

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
                        placeholder="What's your post title?" value="{{ old('title') }}" required="true">
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
                    <textarea id="body" name="body" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write post body here"></textarea>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <i class="fa fa-plus mr-2" aria-hidden="true"></i>
                    Add new post
                </button>
            </div>
        </form>
    </div>
</div>
