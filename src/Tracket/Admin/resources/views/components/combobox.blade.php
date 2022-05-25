<div class="mt-1">
    <label for="combobox" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <div class="relative mt-1">
        <input id="combobox" type="text" class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-12 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" role="combobox" aria-controls="options" aria-expanded="false">
        <input id="combobox-value" name="{{ $name }}" type="hidden" value="{{ $selected }}">
        <button id="combobox-selector" type="button" class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <ul id="options" class="hidden absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" role="listbox">
            @foreach($companies as $externalId => $name)
                <li class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-indigo-600 hover:text-white" id="{{ $externalId }}" role="option" tabindex="-1">
                    <span class="block truncate">{{ $name }}</span>
                </li>
            @endforeach
        </ul>

        <span id="checkmark" class="hidden absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </span>
    </div>
</div>

<script>
    let combobox = document.getElementById('combobox');
    let comboboxValue = document.getElementById('combobox-value');
    let comboboxSelector = document.getElementById('combobox-selector');
    let options = document.getElementById('options');
    let checkmark = document.getElementById('checkmark');

    combobox.addEventListener('focus', (e) => {
        showOptions()
    })
    combobox.addEventListener('focusout', (e) => {
        if (e.relatedTarget && e.relatedTarget.tagName === 'LI' && e.relatedTarget.id) {
            comboboxValue.value = e.relatedTarget.id;
            updateSelectedOption()
        }
        hideOptions()
    })

    const showOptions = () => {
        options.classList.remove('hidden')
    }

    const hideOptions = () => {
        options.classList.add('hidden')
    }

    const updateSelectedOption = () => {
        let selected = options.children.namedItem(comboboxValue.value)
        if (selected) {
            combobox.value = selected.firstElementChild.innerHTML;
            selected.appendChild(checkmark)
            checkmark.classList.remove('hidden')
        }
    }

    updateSelectedOption()
</script>

