<div>
    <div class="d-grid p-2">
        <button type="button" class="btn btn-dark d-grid" wire:click="add">Add</button>
    </div>
    @foreach($variations as $variation)
        <div class="d-flex justify-content-between p-2" wire:key="{{$loop->index}}">
            <input type="text" class="input input-bordered d-grid" placeholder="Name"
                   wire:model.defer="variations.{{$loop->index}}.name">
            <input type="number" class="input input-bordered" placeholder="Count"
                   wire:model.defer="variations.{{$loop->index}}.count">
            <input type="number" class="input input-bordered" placeholder="Price"
                   wire:model.defer="variations.{{$loop->index}}.price">
            <a class="link-danger" wire:click="delete" wire:key="{{$loop->index}}">Delete
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-folder-minus" viewBox="0 0 16 16">
                    <path
                        d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"></path>
                    <path d="M11 11.5a.5.5 0 0 1 .5-.5h4a.5.5 0 1 1 0 1h-4a.5.5 0 0 1-.5-.5z"></path>
                </svg>
            </a>
        </div>
    @endforeach
    @if(count($variations))
        <div class="d-grid p-2">
            <button type="button" class="btn btn-dark d-grid" wire:click="save">Save variation</button>
        </div>
    @endif
</div>
