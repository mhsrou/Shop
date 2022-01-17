<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <div class="position-relative">

                    {{--gallary--}}
                    <div id="carouselExampleControls" class="carousel slide mb-5" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->images as $image)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($image->url) }}"
                                         class="d-block w-100"
                                         alt="{{ $image->name }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="badge bg-danger text-white position-absolute m-1 top-0 start-0">
                        {{ $product->discount }}%
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="small mb-1">{{ $product->updated_at }}</div>
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">{!! number_format($product->price) !!}</span>
                    {{ number_format(($product->price ?? 0) * (100 - $product->discount)/100) }}
                </div>
                <p class="lead">{!! $product->desc !!}</p>
                <div class="p-2">
                    <select class="form-select mt-3 mb-4" wire:model="selected_variation">
                        <option value="null" disabled>Select Variation</option>
                        @foreach($product->variations as $variation)
                            <option value="{{ $variation->id }}">{{ $variation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                           style="max-width: 3rem"/>
                    <button class="btn btn-outline-dark flex-shrink-0" type="button"
                            wire:click="addToCard({{ $product->id }})">
                        <i class="bi-cart-fill me-1"></i>
                        Add to card
{{--                        {{ is_array(session()->get('card')) && array_key_exists($product->id, session()->get('card')) ? sprintf('(%s)', session()->get('card')[$product->id]['count']) : '' }}--}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
