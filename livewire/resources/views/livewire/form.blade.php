<div>
    <label for="">
        <span>Titulo</span>
        <input type="text" class="m-2 rounded-lg border-1" wire:model="title">
    </label>
    @error('title')
        <span>  {{$message}}</span>
    @enderror
</div>

<div>
    <label for="">
        <span></span>

        <textarea name="" wire:model="body" class="m-2  rasize rounded-md textarea  h-24 border-1 " id="" cols="30" rows="10"></textarea>
    </label>
    @error('title')
        <span>  {{$message}}</span>
    @enderror
</div>
