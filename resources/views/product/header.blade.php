<header class="bg-dark py-5">
    <style>
        .carousel img {
    height: 220px;
    width: 100%;
    object-fit: scale-down;
    object-position: center;
}
    </style>
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach($sliders as $slider)
                    <div class="carousel-item @if ($loop->first)active @endif">
                        <a href="{{ route('show', $slider) }}">
                            <div class="cards-wrapper">
                                <div class="card">
                                    <div class="badge bg-info text-white position-absolute m-1">
                                        {{ $slider->discount }}%
                                    </div>
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($slider->images[0]->url) }}"
                                        class="card-img-top" alt="...">
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</header>
