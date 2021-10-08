@props(['name'])

@once
    @push('styles')
        <style>
            .image-input-container {
                width: 100%;
                height: 100%;
                background: #FFF;
                position: relative;
                box-shadow: 0 0.5rem 1.5rem 0.5rem #e1e1e1;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 5px;
            }

            .image-input-container img {
                width: 94%;
            }

            i.image-input-action {
                position: absolute;
                background: white;
                border-radius: 50%;
                box-shadow: 0 0.5rem 1.5rem 0.5rem #e3e3e3;
                cursor: pointer;
                color: #a2a2a2;
            }
            i.image-input-change {
                right: 0;
                top: 0;
                transform: translate(calc(50% - 5px), calc(-50% + 5px));
                padding: 9px;
                font-size: 14px;
            }
            i.image-input-remove {
                bottom: 0;
                right: 0;
                transform: translate(calc(50% - 7px), calc(50% - 7px));
                padding: 7px 9px;
                font-size: 15px;
            }

            .image-input-container.has-error {
                border: 1px solid #F64E60;
                box-shadow: none;
            }
            .image-input-container .input-error {
                position: absolute;
                bottom: -10px;
                left: 5px;
                transform: translateY(100%);
            }
        </style>
    @endpush
@endonce

<div class="image-input-container {{ $errors->has($name) ? 'has-error' : '' }}">
    <input type="file" accept=".png, .jpg, .jpeg" name="{{ $name }}" class="hidden">
    <i class="image-input-action image-input-change fa fa-pen"></i>
    <i class="image-input-action image-input-remove fa fa-times hidden"></i>
    <img src="https://www.timesquare-cologne.de/wp-content/uploads/2014/09/default-placeholder.jpg">
    @if($errors->has($name))
        <p class="input-error">{{ $errors->first($name) }}</p>
    @endif
</div>

@once
    @push('scripts')
        <script>
            const defaultImageInputURL = 'https://www.timesquare-cologne.de/wp-content/uploads/2014/09/default-placeholder.jpg';

            $(document).ready(function () {
                $('.image-input-change').on('click', function () {
                    $(this).parent().find("input[type='file']").click();
                });
                $('.image-input-container input[type="file"]').on('change', function () {
                    const file = $(this).prop('files')[0];
                    $(this).siblings('img').attr('src', URL.createObjectURL(file));
                    $(this).siblings('.image-input-remove').removeClass('hidden');
                });
                $('.image-input-remove').on('click', function () {
                    $(this).siblings('img').attr('src', defaultImageInputURL);
                    $(this).addClass('hidden');
                    $(this).siblings('input[type="file"]').val('');
                });
            });
        </script>
    @endpush
@endonce
