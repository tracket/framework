<div class="relative flex items-start">
    <div class="flex items-center h-5">
        <input type="hidden" name="{{ $setting->getName() }}" value="0">
        <input id="{{ $setting->getName() }}"
               aria-describedby="{{ $setting->getName() }}"
               name="{{ $setting->getName() }}"
               value="1"
               {{ $setting->getValue() ? 'checked' : '' }}
               type="checkbox"
               class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
    </div>
    <div class="ml-3 text-sm">
        <label for="comments" class="font-medium text-gray-700">{{ Str::ucfirst(Str::replace('_', ' ', $setting->getName())) }}</label>
        <p id="comments-description" class="text-gray-500">{{ $setting->getDescription() }}</p>
    </div>
</div>
