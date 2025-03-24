@extends('layouts.main-guest')

@section('content')
    <div>
        <!-- Button Section -->
        <div class="fixed bottom-8 right-4 flex flex-row gap-5 z-50">
            {{-- Scroll Button --}}
            <a href="#detail"
                class="text-6xl font-extrabold hover:shadow-[6px_6px_0px_#1D1D1D] px-2 py-2 bg-[#EF4444] border-[5px] border-black rounded-2xl hover:scale-105 transform duration-300 ease-in-out">
                <i class="mdi mdi-chevron-double-down"></i>
            </a>
            <a href="#home"
                class="text-6xl font-extrabold hover:shadow-[6px_6px_0px_#1D1D1D] px-2 py-2 bg-[#FACC15] border-[5px] border-black rounded-2xl hover:scale-105 transform duration-300 ease-in-out">
                <i class="mdi mdi-chevron-double-up"></i>
            </a>
        </div>

        <section id="home" class="min-h-screen flex flex-col justify-between items-center pb-10">
            <!-- Header Section -->
            <div class="flex-1 flex flex-col justify-center items-center text-center space-y-4">
                <h1
                    class="text-6xl font-extrabold shadow-[6px_6px_0px_#1D1D1D] px-6 py-4 bg-[#3B82F6] border-[5px] border-black rotate-[-3deg] hover:scale-105 transform duration-300 ease-in-out">
                    Welcome to Another Portfolio Web
                </h1>
                <p
                    class="text-4xl font-extrabold shadow-[6px_6px_0px_#1D1D1D] px-6 py-4 bg-[#F97316] border-[5px] border-black rotate-[1deg] hover:scale-105 transform duration-300 ease-in-out">
                    Made by Muhammad Akbar Abi Santoso
                </p>
                <p
                    class="text-3xl font-extrabold shadow-[6px_6px_0px_#1D1D1D] px-6 py-4 bg-[#14B8A6] border-[5px] border-black rotate-[-3deg] hover:scale-105 transform duration-300 ease-in-out">
                    Another huh, Damn it
                </p>
            </div>
        </section>

        <section id="detail" class="min-h-screen">

            {{-- Navigate Card --}}
            <div class="flex flex-col md:flex-row space-y-6 md:space-x-10 md:space-y-0">
                <!-- Card 1 -->
                <x-card
                    class="w-full bg-[#FFDAB9] transform duration-300 ease-in-out hover:-translate-x-2 hover:-translate-y-2 hover:rotate-[2deg]"
                    title="Project" desc="A place where all my works are displayed, made by me"
                    route="{{ route('guest.project') }}" btnText="Click me 😎" btnClass="bg-[#EF4444]" />

                <!-- Card 2 -->
                <x-card class="w-full bg-[#A7C7E7] duration-300 ease-in-out hover:-translate-y-2 " title="About"
                    desc="A place where you can know me better" route="{{ route('guest.about') }}"
                    btnText="Learn about me 🙎‍♂️" btnClass="bg-[#2563EB]" />

                <!-- Card 3 -->
                <x-card
                    class="w-full bg-[#D4D4D8] duration-300 ease-in-out hover:-translate-x-2 hover:-translate-y-2 hover:rotate-[-2deg]"
                    title="No Idea" desc="A place where i dont know, didn't think about it yet"
                    route="{{ route('guest.noidea') }}" btnText="No idea yet 😅" btnClass="bg-[#FACC15] text-black" />
            </div>

            {{-- Latest Works --}}
            <div class="bg-[#F3F4F6] shadow-[6px_6px_0px_#1D1D1D] w-full mt-5 p-4 border-[5px] border-black">
                <h2 class="text-3xl font-extrabold mb-4">LATEST WORK</h2>
                <div class="flex flex-col md:flex-row md:space-x-10 space-y-6 md:space-y-0">
                    <div
                        class="bg-[#FFDAB9] shadow-[6px_6px_0px_#1D1D1D] min-h-80 p-4 border-[5px] border-black transform duration-300 ease-in-out hover:-translate-x-2 hover:-translate-y-2 flex flex-col">
                        <div class="flex-grow">
                            <h3 class="text-3xl font-extrabold mb-4">See all my works</h3>
                            <p class="text-lg">A place where all my works are displayed, made by me</p>
                        </div>
                        <button
                            class="mt-auto px-4 py-2 bg-[#DC2626] shadow-[6px_6px_0px_#1D1D1D] text-white font-bold border-4 border-black cursor-pointer transition-transform hover:-translate-x-1 hover:-translate-y-1">
                            Action
                        </button>
                    </div>

                    <div
                        class="bg-[#A7C7E7] shadow-[6px_6px_0px_#1D1D1D] min-h-80 p-4 border-[5px] border-black transform duration-300 ease-in-out hover:-translate-x-2 hover:-translate-y-2 flex flex-col">
                        <div class="flex-grow">
                            <h3 class="text-3xl font-extrabold mb-4">See all my works</h3>
                            <p class="text-lg">A place where all my works are displayed, made by me</p>
                        </div>
                        <button
                            class="mt-auto px-4 py-2 bg-[#EA580C] shadow-[6px_6px_0px_#1D1D1D] text-white font-bold border-4 border-black cursor-pointer transition-transform hover:-translate-x-1 hover:-translate-y-1">
                            Action
                        </button>
                    </div>

                    <div
                        class="bg-[#D4D4D8] shadow-[6px_6px_0px_#1D1D1D] min-h-80 p-4 border-[5px] border-black transform duration-300 ease-in-out hover:-translate-x-2 hover:-translate-y-2 flex flex-col">
                        <div class="flex-grow">
                            <h3 class="text-3xl font-extrabold mb-4">See all my works</h3>
                            <p class="text-lg">A place where all my works are displayed, made by me</p>
                        </div>
                        <button
                            class="mt-auto px-4 py-2 bg-[#EAB308] shadow-[6px_6px_0px_#1D1D1D] text-black font-bold border-4 border-black cursor-pointer transition-transform hover:-translate-x-1 hover:-translate-y-1">
                            Action
                        </button>
                    </div>
                </div>
            </div>

        </section>
    </div>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', event => {
                event.preventDefault();
                document.querySelector(anchor.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection
