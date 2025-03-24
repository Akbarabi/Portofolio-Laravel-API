@props(['pagination'])

@php
    $currentPage = $pagination['currentPage'];
    $totalPages = $pagination['totalPages'];
@endphp

@if ($totalPages > 0)
    <nav class="flex justify-center mt-4">
        <ul class="flex space-x-2 items-center">
            {{-- Previous Page --}}
            <li>
                <a href="{{ $currentPage > 1 ? url()->current() . '?' . http_build_query(array_merge(request()->except('page'), ['page' => $currentPage - 1])) : '#' }}"
                    class="px-3 py-1 rounded-md {{ $currentPage > 1 ? 'bg-gray-800 text-indigo-400 hover:bg-gray-900' : 'bg-gray-700 text-gray-400 cursor-not-allowed' }}">
                    Previous
                </a>
            </li>

            {{-- Page Numbers --}}
            @foreach (range(1, $totalPages) as $page)
                <li>
                    <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['page' => $page])) }}"
                        class="px-3 py-1 rounded-md {{ $page == $currentPage ? 'bg-indigo-900 text-indigo-400' : 'bg-gray-800 text-indigo-400 hover:bg-gray-900' }}">
                        {{ $page }}
                    </a>
                </li>
            @endforeach

            {{-- Next Page --}}
            <li>
                <a href="{{ $currentPage < $totalPages ? url()->current() . '?' . http_build_query(array_merge(request()->except('page'), ['page' => $currentPage + 1])) : '#' }}"
                    class="px-3 py-1 rounded-md {{ $currentPage < $totalPages ? 'bg-gray-800 text-indigo-400 hover:bg-gray-900' : 'bg-gray-700 text-gray-400 cursor-not-allowed' }}">
                    Next
                </a>
            </li>
        </ul>
    </nav>
@endif