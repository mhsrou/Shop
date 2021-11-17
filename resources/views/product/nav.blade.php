<nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #f8d7da;">

    <div class="container px-3 px-lg-5">
        <a class="navbar-brand" href="{{route('home')}}">Shop Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('category.index')}}">Category</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('profile.index')}}">Profile</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('all')}}">All Products</a></li>
                        <li>
                            <hr class="dropdown-divider"/>
                        </li>
                        <li><a class="dropdown-item" href="{{route('incredible')}}">Incredible Items</a></li>
                        <li><a class="dropdown-item" href="{{route('soon')}}">Soon Arrivals</a></li>
                        <li><a class="dropdown-item" href="{{route('running_out')}}">Running Out</a></li>
                    </ul>
                </li>
            </ul>
            @livewire('card')
        </div>
    </div>
</nav>
