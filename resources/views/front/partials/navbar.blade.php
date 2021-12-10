<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">eCommerce Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
            </ul>
        </div>
        <div class="">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger"><i class="fad fa-sign-out me-2"></i>Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success"><i class="fad fa-sign-in me-2"></i>Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary"><i class="fad fa-user-plus me-2"></i>Register</a>
            @endauth
        </div>
    </div>
</nav>
