<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-900 antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-gray-100 dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Панель управления</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Авторизация</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Регистрация</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
                <div>
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>

                @auth
                <a href="/dashboard" class="mt-16 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Перейти к списку лидов
                </a>

                @else
                <div class="mt-16 w-full sm:max-w-lg mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white mb-4 text-center">
                        Создание нового лида
                    </h1>

                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                    <!-- Alerts -->
                    <x-alerts class="mb-4"/>

                    <form method="POST" action="{{ route('create-lead') }}">
                        @csrf

                        <div class="grid grid-cols-2">
                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="first_name" :value="__('Имя')" />
                                <x-text-input id="first_name" class="block mt-1 w-full"
                                                type="text"
                                                :value="old('first_name')"
                                                name="first_name"
                                                placeholder="Иван"
                                                required />

                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="last_name" :value="__('Фамилия')" />
                                <x-text-input id="last_name" class="block mt-1 w-full"
                                                type="text"
                                                :value="old('last_name')"
                                                name="last_name"
                                                placeholder="Иванов"
                                                required />

                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="phone" :value="__('Номер телефона')" />
                                <x-text-input id="phone" class="block mt-1 w-full"
                                                :value="old('phone')"
                                                type="tel"
                                                name="phone"
                                                placeholder="+7 999 999-99-99"
                                                required />

                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="email" :value="__('E-Mail')" />
                                <x-text-input id="email" class="block mt-1 w-full"
                                                :value="old('email')"
                                                type="email"
                                                name="email"
                                                placeholder="example@domain.com"
                                                required />

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="lead_text" :value="__('Текст обращения')" />
                            <textarea id="lead_text" name="lead_text" rows="4" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Текст обращения...">{{ old('lead_text') }}</textarea>

                            <x-input-error :messages="$errors->get('lead_text')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 w-full">
                            <x-primary-button class="w-full justify-center">
                                {{ __('Отправить') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                @endauth

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm sm:text-left">
                        &nbsp;
                    </div>

                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        Nikita's test assignment for the InfoService company (@westlik1)
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
