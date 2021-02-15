<label>
    <select class="custom-select" name="per-page">
        <option
            @if(app('request')->input('per-page') == ($default_per_page ?? 15)) selected @endif
            value="{{ Request::fullUrlWithQuery(array_merge(request()->except('per-page'),
                        ['per-page' => $default_per_page ?? 15])) }}"
        >
            {{ $default_per_page ?? 15 }}
        </option>
        <option
            @if(app('request')->input('per-page') == 25) selected @endif
            value="{{ Request::fullUrlWithQuery(array_merge(request()->except('per-page'), ['per-page' => 25])) }}"
        >
            25
        </option>
        <option
            @if(app('request')->input('per-page') == 50) selected @endif
            value="{{ Request::fullUrlWithQuery(array_merge(request()->except('per-page'), ['per-page' => 50])) }}"
        >
            50
        </option>
    </select>
</label>

@push('inline_scripts')
    <script>
        document.querySelector('select[name=per-page]').addEventListener('change', function (e) {
            showLoader();
            window.location.replace(e.target.value);
        });
    </script>
@endpush
