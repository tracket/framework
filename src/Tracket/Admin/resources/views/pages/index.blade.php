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
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Pages</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all pages.</p>
        </div>
        @permission(Tracket\Permissions\Models\Permission::ADMIN_PAGES_CREATE)
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add Page</a>
            </div>
        @endpermission
    </div>
    <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Slug</th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">External ID</th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
            @foreach ($pages as $page)
                <tr>
                    <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                        {{ $page->getTitle() }}
                        <dl class="font-normal lg:hidden">
                            <dt class="sr-only">Slug</dt>
                            <dd class="mt-1 truncate text-gray-700">{{ $page->getSlug() }}</dd>
                            <dt class="sr-only">External ID</dt>
                            <dd class="mt-1 truncate text-gray-700">{{ $page->getExternalId() }}</dd>
                        </dl>
                    </td>
                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ $page->getSlug() }}</td>
                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ $page->getExternalId() }}</td>
                    <td class="py-4 pl-3 pr-4 space-x-3 text-right text-sm font-medium sm:pr-6">
                        <a href="{{ route('web.pages.show', ['slug' => $page->getSlug()]) }}" class="text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, {{ $page->getTitle() }}</span></a>
                        <a href="{{ route('admin.pages.edit', $page->getExternalId()) }}" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, {{ $page->getTitle() }}</span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
