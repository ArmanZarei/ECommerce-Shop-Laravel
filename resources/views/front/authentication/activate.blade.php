@extends('front.layouts.master')

@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/common/formcomponents.css') }}">
@endpush

@push('scripts')
    <script>
        const sendAgainBtn = document.getElementById('send-again-txt');
        const timerContainer = document.getElementById('timer-container');
        let expiresIn = {{ $expiresIn }};
        setCountDownTimer();
        function setCountDownTimer() {
            let min = Math.floor(expiresIn/60)
            let sec = expiresIn % 60;
            if (sec < 10)
                sec = '0' + sec;
            timerContainer.innerText = `${min}:${sec}`;
        }
        let timerInterval = setInterval(function () {
            expiresIn--;
            if (expiresIn <= 0) {
                sendAgainBtn.parentElement.classList.remove('disabled');
                timerContainer.innerText = '';
                sendAgainBtn.classList.remove('d-none');
                clearInterval(timerInterval);
            } else {
                setCountDownTimer();
            }
        }, 1000);
    </script>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 offset-lg-4 offset-md-2">
                <div class="card">
                    <div class="card-header"><i class="fad fa-key me-2"></i>Activate your account</div>
                    <div class="card-body">
                        <x-form.form action="{{ route('activation.action') }}">
                            <x-form.inputs.text name="code" />
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="d-flex mt-2 justify-content-between">
                                <x-form.inputs.submit />
                                <a href="{{ route('activation.page') }}" class="btn btn-style-1 no-duration btn-light-success disabled">
                                    <span id="send-again-txt" class="d-none"><i class="fa fa-redo me-2"></i>Send again</span>
                                    <span id="timer-container"></span>
                                </a>
                            </div>
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
