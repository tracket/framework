@extends('admin::layouts.admin')

@section('content')
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

    <form method="POST" action="{{ route('admin.themes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="pb-5 mb-0 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-2xl leading-6 font-medium text-gray-900">Upload Theme</h3>
            <div class="mt-3 flex sm:mt-0 sm:ml-4">
                <a href="{{ route('admin.themes.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Upload</button>
            </div>
        </div>
        <div class="bg-white shadow sm:rounded-md px-4 py-5 border-b border-gray-200 sm:px-6">
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 pb-4 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <div class="sm:col-span-6">
                            <label for="theme" class="block text-sm font-medium text-gray-700">Theme</label>
                            <div class="mt-1 flex items-center">
                                <input id="theme" name="theme" type="file" class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
