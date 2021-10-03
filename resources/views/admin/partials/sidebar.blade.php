<main id="main-page">
    <div class="d-flex flex-column flex-shrink-0 text-white" id="sidebar">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none m-3">
            <i class="fab fa-2x fa-wordpress me-2"></i>
            <span class="fs-4">Wordpress</span>
        </a>
        <hr>
        <div class="custom-scrollable">
            <ul class="nav nav-pills flex-column mb-auto" id="sidebar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link d-flex align-items-center active" aria-current="page">
                        <i class="fad fa-home me-3 nav-item-icon"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-tachometer-slowest me-3 nav-item-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h5>Shop</h5>
                </li>
                <li>
                    <a class="nav-link d-flex align-items-center collapsed collapse-btn" data-bs-toggle="collapse" href="#brands-collapse">
                        <i class="fad fa-trademark me-3 nav-item-icon"></i>
                        <span>Brands</span>
                        <i class="fas fa-xs fa-chevron-right ms-auto"></i>
                    </a>
                    <ul class="sidebar-sub-nav collapse" id="brands-collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.brands.index') }}" class="nav-link d-flex align-items-center">
                                <i class="fad fa-list me-2 nav-item-icon"></i>
                                <span>List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.brands.create') }}" class="nav-link d-flex align-items-center">
                                <i class="fa fa-plus me-2 nav-item-icon"></i>
                                <span>Create</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link d-flex align-items-center collapsed collapse-btn" data-bs-toggle="collapse" href="#attributes-collapse">
                        <i class="fad fa-list-alt me-3 nav-item-icon"></i>
                        <span>Attributes</span>
                        <i class="fas fa-xs fa-chevron-right ms-auto"></i>
                    </a>
                    <ul class="sidebar-sub-nav collapse" id="attributes-collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('admin.attributes.index') }}" class="nav-link d-flex align-items-center">
                                <i class="fad fa-list me-2 nav-item-icon"></i>
                                <span>List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.attributes.create') }}" class="nav-link d-flex align-items-center">
                                <i class="fa fa-plus me-2 nav-item-icon"></i>
                                <span>Create</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-section mt-5">
                    <h5>Blog</h5>
                </li>
                <li>
                    <a class="nav-link d-flex align-items-center collapsed collapse-btn" data-bs-toggle="collapse" href="#posts-collapse">
                        <i class="fad fa-clone me-3 nav-item-icon"></i>
                        <span>Posts</span>
                        <i class="fas fa-xs fa-chevron-right ms-auto"></i>
                    </a>
                    <ul class="sidebar-sub-nav collapse" id="posts-collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fad fa-list me-2 nav-item-icon"></i>
                                <span>List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fa fa-plus me-2 nav-item-icon"></i>
                                <span>Create</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link d-flex align-items-center collapsed collapse-btn" data-bs-toggle="collapse" href="#authors-collapse">
                        <i class="fad fa-user-edit me-3 nav-item-icon"></i>
                        <span>Authors</span>
                        <i class="fas fa-xs fa-chevron-right ms-auto"></i>
                    </a>
                    <ul class="sidebar-sub-nav collapse" id="authors-collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fad fa-list me-2 nav-item-icon"></i>
                                <span>List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fa fa-plus me-2 nav-item-icon"></i>
                                <span>Create</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link d-flex align-items-center collapsed collapse-btn" data-bs-toggle="collapse" href="#categories-collapse">
                        <i class="fad fa-sitemap me-3 nav-item-icon"></i>
                        <span>Categories</span>
                        <i class="fas fa-xs fa-chevron-right ms-auto"></i>
                    </a>
                    <ul class="sidebar-sub-nav collapse" id="categories-collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fad fa-list me-2 nav-item-icon"></i>
                                <span>List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fa fa-plus me-2 nav-item-icon"></i>
                                <span>Create</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link d-flex align-items-center collapsed collapse-btn" data-bs-toggle="collapse" href="#tags-collapse">
                        <i class="fad fa-tags me-3 nav-item-icon"></i>
                        <span>Tags</span>
                        <i class="fas fa-xs fa-chevron-right ms-auto"></i>
                    </a>
                    <ul class="sidebar-sub-nav collapse" id="tags-collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fad fa-list me-2 nav-item-icon"></i>
                                <span>List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fa fa-plus me-2 nav-item-icon"></i>
                                <span>Create</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-comments me-3 nav-item-icon"></i>
                        <span>Comments</span>
                        <span class="sidebar-badge sidebar-blue-badge ms-auto">6</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h5>Shop</h5>
                </li>
                <li>
                    <a class="nav-link d-flex align-items-center collapsed collapse-btn" data-bs-toggle="collapse" href="#orders-collapse">
                        <i class="fad fa-shopping-cart me-3 nav-item-icon"></i>
                        <span>Orders</span>
                        <i class="fas fa-xs fa-chevron-right ms-auto"></i>
                    </a>
                    <ul class="sidebar-sub-nav collapse" id="orders-collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fad fa-list me-2 nav-item-icon"></i>
                                <span>List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class="fa fa-plus me-2 nav-item-icon"></i>
                                <span>Create</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-box-full me-3 nav-item-icon"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-users me-3 nav-item-icon"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-percentage me-3 nav-item-icon"></i>
                        <span>Discounts</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-shipping-fast me-3 nav-item-icon"></i>
                        <span>Shipments</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-comments me-3 nav-item-icon"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h5>Setting</h5>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-cogs me-3 nav-item-icon"></i>
                        <span>General Setting</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-share-square me-3 nav-item-icon"></i>
                        <span>Social Media</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-bell me-3 nav-item-icon"></i>
                        <span>Notifications</span>
                        <span class="sidebar-badge sidebar-red-badge ms-auto">New</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link d-flex align-items-center">
                        <i class="fad fa-poll me-3 nav-item-icon"></i>
                        <span>Statistics</span>
                    </a>
                </li>
            </ul>
        </div>
        <hr class="mt-auto mb-0">
        <a href="#" class="d-flex align-items-center text-decoration-none text-danger pt-3 pb-3">
            <i class="fad fa-sign-out me-3 ms-3"></i>
            <span style="font-size: 14px">Logout</span>
        </a>
    </div>
</main>
