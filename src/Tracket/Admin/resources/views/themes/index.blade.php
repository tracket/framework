@extends('admin::layouts.admin')

@section('content')
    @if (session('success-message'))
        <div id="success-message" class="rounded-md bg-green-50 p-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: solid/check-circle -->
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success-message') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button onclick="document.getElementById('success-message').remove()" type="button" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                            <span class="sr-only">Dismiss</span>
                            <!-- Heroicon name: solid/x -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
        @if ($errors->any())
            <div id="error-message" class="rounded-md bg-red-50 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm font-medium text-red-800">{{ $error }}</p>
                        @endforeach
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button onclick="document.getElementById('error-message').remove()" type="button" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
                                <span class="sr-only">Dismiss</span>
                                <!-- Heroicon name: solid/x -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Themes</h1>
            <p class="mt-2 text-sm text-gray-700">Change the look and feel of your job board with themes.</p>
        </div>
        @permission(Tracket\Permissions\Models\Permission::ADMIN_THEMES_UPLOAD)
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('admin.themes.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add Theme</a>
            </div>
        @endpermission
    </div>
    <ul role="list" class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($themes as $theme)
            <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                <div class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="flex-1 flex flex-col p-8">
                        <h3 class="mt-6 text-gray-900 text-sm font-medium">{{ $theme['name'] }}</h3>
                        <dl class="mt-1 flex-grow flex flex-col justify-between">
                        <dd class="text-gray-500 text-sm">{{ $theme['descripton'] }}</dd>
                        </dl>
                    </div>
                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            @if ($theme['name'] === $current)
                            <div class="w-0 flex-1 flex">
                                <div class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-500 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                    <span class="ml-2 cursor-default">Delete</span>
                                </div>
                            </div>
                            @else
                                <div class="w-0 flex-1 flex">
                                    <form method="POST" action="{{ route('admin.themes.destroy', ['theme' => $theme['name']]) }}" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('admin.themes.destroy', ['theme' => $theme['name']]) }}"
                                           onclick="event.preventDefault();if(confirm('Are you sure?')===true){this.closest('form').submit();}"
                                           class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-indigo-600">
                                            <span class="ml-2">Delete</span>
                                        </a>
                                    </form>
                                </div>
                            @endif
                            @if ($theme['name'] === $current)
                                <div class="-ml-px w-0 flex-1 flex">
                                    <div class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-500 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                        <span class="ml-2 cursor-default">Default</span>
                                    </div>
                                </div>
                            @else
                                <div class="-ml-px w-0 flex-1 flex">
                                    <form method="POST" action="{{ route('admin.themes.update', ['theme' => $theme['name']]) }}" class="w-full">
                                        @csrf
                                        @method('PUT')

                                        <a href="#" onclick="event.preventDefault();this.closest('form').submit();" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-indigo-600">
                                            <span class="ml-2">Use</span>
                                        </a>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
