<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eCommerce Shop - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
</head>
<body>
<div class="d-flex">
    @include('admin.partials.sidebar')
    <div class="flex-grow-1" style="background: #EEF0F8;">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid ps-4 pe-4">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav" id="top-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Pages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Apps</a>
                        </li>
                    </ul>
                    <div class="flex-shrink-0 dropdown ms-auto">
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span id="welcome-text" class="me-2">Hi, <span>Arman</span></span>
                            <span id="user-avatar-substitute">A</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="user-dropdown" id="user-dropdown-menu">
                            <li class="user-menu-item">
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="fad fa-user-edit color-green"></i>
                                    <div class="d-flex flex-column user-menu-item-text">
                                        <span>My Profile</span>
                                        <span>Account settings and more</span>
                                    </div>
                                </a>
                            </li>
                            <li class="user-menu-item">
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="fad fa-cogs color-red"></i>
                                    <div class="d-flex flex-column user-menu-item-text">
                                        <span>My Messages</span>
                                        <span>Inbox and tasks</span>
                                    </div>
                                </a>
                            </li>
                            <li class="user-menu-item">
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="fad fa-calendar-alt color-blue"></i>
                                    <div class="d-flex flex-column user-menu-item-text">
                                        <span>My Activities</span>
                                        <span>Logs and notifications</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid p-4 rounded-2">
            <div class="row">
                <div class="col-6">
                    <div class="card border-0 bg-white rounded-2">
                        <h5 class="card-header bg-white">Buttons</h5>
                        <div class="card-body">
                            <a href="#" class="btn btn-style-1 no-duration btn-light-success mr-2">Success</a>
                            <a href="#" class="btn btn-style-1 no-duration btn-light-primary mr-2">Primary</a>
                            <a href="#" class="btn btn-style-1 no-duration btn-light-danger mr-2">Danger</a>
                            <a href="#" class="btn btn-style-1 no-duration btn-light-warning mr-2">Warning</a>
                            <a href="#" class="btn btn-style-1 no-duration btn-light-dark">Dark</a>
                        </div>
                    </div>
                    <div class="card border-0 bg-white rounded-2 mt-2">
                        <h5 class="card-header bg-white">Labels</h5>
                        <div class="card-body">
                            <span class="label-style-1 label-light-danger">Danger</span>
                            <span class="label-style-1 label-light-primary">Primary</span>
                            <span class="label-style-1 label-light-success">Success</span>
                            <span class="label-style-1 label-light-info">Info</span>
                            <span class="label-style-1 label-light-warning">Warning</span>
                            <span class="label-style-1 label-light-dark">Dark</span>

                            <hr>

                            <span class="label-style-1 label-light-danger label-bold">Danger</span>
                            <span class="label-style-1 label-light-primary label-bold">Primary</span>
                            <span class="label-style-1 label-light-success label-bold">Success</span>
                            <span class="label-style-1 label-light-info label-bold">Info</span>
                            <span class="label-style-1 label-light-warning label-bold">Warning</span>
                            <span class="label-style-1 label-light-dark label-bold">Dark</span>
                        </div>
                    </div>
                    <div class="card border-0 bg-white rounded-2 mt-2">
                        <h5 class="card-header bg-white">Accordions</h5>
                        <div class="card-body p-4">
                            <div class="accordion custom-accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fal fa-layer-group"></i><span>User Permissions</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            First
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fal fa-bell"></i><span>Notifications</span>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Second
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="fal fa-key"></i><span>Privileges</span>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Third
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 bg-white p-0 tab-container">
                    <nav>
                        <div class="nav nav-tabs" role="tablist">
                            <button class="nav-link d-flex align-items-center active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fad fa-envelope me-1"></i>Emails</button>
                            <button class="nav-link d-flex align-items-center" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fad fa-bell me-1"></i>Notifications</button>
                            <button class="nav-link d-flex align-items-center" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fad fa-users me-1"></i>Contacts</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">Emails</div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Notifications</div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Contacts</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="card border-0 bg-white rounded-2">
                        <h5 class="card-header bg-white">Form</h5>
                        <div class="card-body">
                            <form class="custom-form me-5 ms-5 mt-2">
                                <div class="floating-label-container mb-3">
                                    <input type="text" name="email" autocomplete="off" placeholder=" ">
                                    <label>Email</label>
                                </div>
                                <div class="floating-label-container mb-4">
                                    <input type="password" name="password" autocomplete="off" placeholder=" ">
                                    <label>Password</label>
                                </div>
                                <button class="btn btn-style-1 no-duration btn-light-primary mr-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/common/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
