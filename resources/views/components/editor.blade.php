@if (!empty($label))
    <label for="{{ $name }}">{{ $label }}</label>
@endif
<div id="{{ $name }}">
    <div class="editor">
        {{ $slot }}
    </div>
    <input data-{{ $name }} type="hidden" name="{{ $name }}">
</div>
@pushonce('component-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <style>
        .invalid-editor {
            border: solid 1px #ea5455;
            border-radius: 5px;
        }
    </style>
@endpushonce

@pushonce('component-script')
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
@endpushonce
@push('component-script')
    <script>
        const fullEditor_{{ $name }} = new Quill('#{{ $name }} .editor', {
            bounds: '#{{ $name }} .editor',
            modules: {
                formula: true,
                syntax: true,
                toolbar: [
                    [{
                            font: []
                        },
                        {
                            size: []
                        }
                    ],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                            color: []
                        },
                        {
                            background: []
                        }
                    ],
                    [{
                            script: 'super'
                        },
                        {
                            script: 'sub'
                        }
                    ],
                    [{
                            header: '1'
                        },
                        {
                            header: '2'
                        },
                        'blockquote',
                        'code-block'
                    ],
                    [{
                            list: 'ordered'
                        },
                        {
                            list: 'bullet'
                        },
                        {
                            indent: '-1'
                        },
                        {
                            indent: '+1'
                        }
                    ],
                    [
                        'direction',
                        {
                            align: []
                        }
                    ],
                    ['link', 'image', ],
                    ['clean']
                ]
            },
            theme: 'snow'
        });
        fullEditor_{{ $name }}.on('text-change', function(delta, oldDelta, source) {
            $('input[data-{{ $name }}]').val(fullEditor_{{ $name }}.root.innerHTML);
            if ($('[data-{{ $name }}').val() == '<p><br></p>') {
                $('#{{ $name }}').addClass('invalid-editor');
            } else {
                $('#{{ $name }}').removeClass('invalid-editor');
            }
        });
    </script>
@endpush
