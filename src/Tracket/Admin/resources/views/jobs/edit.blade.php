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

    <form id="job-form" method="POST" action="{{ isset($job) ? route('admin.jobs.update', $job->getExternalId()) : route('admin.jobs.store') }}">
        @csrf
        @if (isset($job))
            @method('PUT')
        @endif
        <div class="pb-5 mb-0 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-2xl leading-6 font-medium text-gray-900">{{ isset($job) ? 'Update' : 'Add' }} Job</h3>
            <div class="mt-3 flex sm:mt-0 sm:ml-4">
                <a href="{{ route('admin.jobs.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ isset($job) ? 'Update' : 'Create' }}</button>
            </div>
        </div>
        <div class="bg-white shadow sm:rounded-md px-4 py-5 border-b border-gray-200 sm:px-6">
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 pb-4 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <div class="mt-1">
                            <input id="title" name="title" type="text" value="{{ isset($job) ? $job->getTitle() : old('title') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        @include('admin::components.combobox', [
                            'label'   => 'Company',
                            'name'    => 'company',
                            'options' => $companies,
                            'selected' => isset($job) ? $job->company->getExternalId() : old('company')
                        ])
                    </div>

                    <div class="sm:col-span-4">
                        <label for="application_url" class="block text-sm font-medium text-gray-700">Application URL</label>
                        <div class="mt-1">
                            <input type="text" name="application_url" id="application_url" value="{{ isset($job) ? $job->getApplicationUrl() : old('application_url') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        @include('admin::components.dropdown', [
                            'label'   => 'Type',
                            'name'    => 'type',
                            'options' => collect(\Tracket\Job\Enums\JobType::cases())
                                ->mapWithKeys(function ($type, $key) {
                                    return [$type->value => $type->value];
                                }),
                            'selected' => isset($job) ? $job->getType() : old('type')
                        ])
                    </div>

                    <div class="sm:col-span-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <div class="mt-1">
                            <input type="text" name="location" id="location" value="{{ isset($job) ? $job->getLocation() : old('location') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <fieldset>
                            <legend class="sr-only">Remote OK</legend>
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remote_ok" value="1" {{ ((isset($job) && $job->getRemoteOk()) || old('remote_ok')) ? 'checked' : null }} aria-describedby="remote-ok-description" name="remote_ok" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remote_ok" class="font-medium text-gray-700">Remote OK</label>
                                    <p id="comments-description" class="text-gray-500">This job allows remote work options.</p>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                            <input name="description" type="hidden">
                            <div id="description-editor">{!! isset($job) ? $job->getDescription() : old('description') !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if(isset($job))
        <div class="pt-5 mb-0 sm:flex sm:items-center sm:justify-end">
            <div class="mt-3 flex sm:mt-0 sm:ml-4">
                <form method="POST" action="{{ route('admin.jobs.destroy', $job->getExternalId()) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('admin.jobs.destroy', $job->getExternalId()) }}"
                       onclick="event.preventDefault();if(confirm('Are you sure?')===true){this.closest('form').submit();}"
                       class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete
                    </a>
                </form>

            </div>
        </div>
    @endif

    @push('head-scripts')
        <!-- Main Quill library -->
        <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

        <!-- Theme included stylesheets -->
        <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    @endpush

    <script>
        var quill = new Quill('#description-editor', {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'header': 1 }, { 'header': 2 }],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ]
            },
            theme: 'snow'  // or 'bubble'
        });

        var form = document.getElementById("job-form");
        form.onsubmit = (e) => {
            // Populate hidden form on submit
            let description = document.querySelector('input[name=description]');
            description.value = quill.root.innerHTML;
        };
    </script>
@endsection
