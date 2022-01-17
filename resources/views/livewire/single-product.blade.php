<div class='col m-3'>
    <div class="card h-100">
        <!-- Sale badge-->
        <div class="badge bg-red text-white position-absolute">{{ $product->discount }}%
        </div>
        <!-- Product image-->
        <a class="link-dark" href="{{ route('show', $product) }}">
                <div class="badge bg-danger text-white position-absolute m-1">
                    {{ $product->discount }}%
                </div>
            <!-- Product image-->
            <img class="card-img-top img-fluid"
                 Src="{{\Illuminate\Support\Facades\Storage::url(optional($product->main_image)->url)}}"/>
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                </div>
            </div>
        </a>
        <!-- Product reviews-->
        <div class="d-flex justify-content-center small text-warning mb-2">
            <div class="bi-star-fill"></div>
            <div class="bi-star-fill"></div>
            <div class="bi-star-fill"></div>
            <div class="bi-star-fill"></div>
            <div class="bi-star-fill"></div>
        </div>
        <!-- Product price-->
        <div class="p-2 text-center">
            <span class="text-muted text-decoration-line-through">{{ number_format($variation->price ?? 0) }}</span>
            {{ number_format(($variation->price ?? 0) * (100 - $product->discount)/100) }}
        </div>
        <div class="p-2">
            <select class="form-select mt-3 mb-4" wire:model="selected_variation">
                <option value="null" disabled>Select Variation</option>
                @foreach($product->variations as $variation)
                    <option value="{{ $variation->id }}">{{ $variation->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" @if((count($product->variations) == 0)) disabled
                   @endif wire:click="addToCard({{ $product->id }})">Add to card
                    {{--                    {{ is_array(session()->get('card')) && array_key_exists($product->id, session()->get('card')) ? sprintf('(%s)', session()->get('card')[$product->id]['count']) : '' }}--}}
                </a>
            </div>
        </div>
    </div>
</div>
