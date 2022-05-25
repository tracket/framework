<div class="sm:col-span-4">
    <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
    <div class="mt-1">
        <input id="name" name="name" type="text" value="{{ isset($company) ? $company->getName() : old('name') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
    </div>
</div>
