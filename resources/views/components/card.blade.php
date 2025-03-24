@props(['class' => '', 'title' => '', 'desc' => '', 'btnClass' => '', 'btnText' => '', 'route' => ''])

<div
    class="{{ $class }} shadow-[6px_6px_0px_#1D1D1D] p-4 border-[5px] border-black transform flex flex-col justify-between">
    <div class="flex-grow">
        <h3 class="text-3xl font-extrabold mb-4">{{ $title }}</h3>
        <p class="text-lg">{{ $desc }}</p>
    </div>
    <a href="{{ $route }}"
        class="{{ $btnClass ?? 'text-black' }} mt-4 w-full px-4 py-2 shadow-[6px_6px_0px_#1D1D1D] font-bold border-4 border-black cursor-pointer">
        {{ $btnText }}
    </a>
</div>
