<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Crear nuevo post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">


            <div class="mb-4">
                
                <x-jet-label value="Titulo del post"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="title"/>

                <x-jet-input-error for="title"/>

            </div>

            <div class="mb-4">
                
                <x-jet-label value="Contenido del post"/>            
                <textarea wire:model.defer="content" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" rows="6"></textarea>

                <x-jet-input-error for="content"/>

            </div>

            @if($image)
            
                <img class="mb-4" src="{{ $image->temporaryUrl() }}">

            @endif

            <div class="mb-4">

                <input type="file" wire:model.defer="image" id="{{ $identificador }}">
                <x-jet-input-error for="image"/>

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="image" class="disabled:opacity-25">
                Crear post
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>
</div>
