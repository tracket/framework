<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        @foreach($options as $id => $name)
            <option value="{{ $id }}" @if ($id === $selected) selected @endif>{{ $name }}</option>
        @endforeach
    </select>
</div>
