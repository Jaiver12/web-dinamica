<div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- This example requires Tailwind CSS v2.0+ -->
            <x-table>

                <div class="px-6 py-3 flex items-center">
                    <!-- <input type="text" wire:model="search"> -->

                    <div class="flex items-center">
                        <span>Mostrar</span>

                        <select wire:model="cant" class="mx-2 px-5 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>

                        <span>Entradas</span>
                    </div>

                    <x-jet-input class="flex-1 mx-4" placeholder="Escriba que esta buscando" type="text" wire:model="search"/>

                    @livewire('create-post')
                </div>

                @if($posts->count())

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                            <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')">
                                ID
                            </th>
                            <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('title')">
                                Titulo
                            </th>
                            <th scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('content')">
                                Contenido
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @foreach($posts as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $item->id }}</div>
                                    
                                </td>
                                <td class="px-6 py-4p">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $item->title }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $item->content }}</div>
                                    
                                </td>
                                <td class="px-6 py-4 text-sm font-medium flex">

                                   {{--  @livewire('edit-post', ['post' => $post], key($post->id))  --}} 
                                    <a wire:click="edit( {{$item}} )" class="font-bold py-2 px-4 rounded cursor-pointer bg-green-600 hover:bg-green-500 text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a wire:click="$emit('deletePost', {{$item->id}})" class="ml-2 font-bold py-2 px-4 rounded cursor-pointer bg-red-600 hover:bg-red-500 text-white">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-3">
                        No exixte ningun registro que coincida con su busqueda
                    </div>
                @endif

                @if ($posts->hasPages())
                    <div class="px-6 py-3">
                        {{ $posts->links() }}
                    </div>                      
                @endif

            </x-table>

            <x-jet-dialog-modal wire:model="open_edit">

                <x-slot name="title">
                    Editar el post
                </x-slot>
        
                <x-slot name="content">
        
                    <div class="mb-4">
        
                        <x-jet-label value="Titulo del post" />
                        <x-jet-input type="text" class="w-full" wire:model="post.title" />
        
                        <x-jet-input-error for="title"/>
                    </div>
        
        
                    <div class="mb-4">
                        
                        <x-jet-label value="Contenido del post"/>            
                        <textarea wire:model="post.content" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" rows="6"></textarea>
        
                        <x-jet-input-error for="content"/>
        
                    </div>
        
                    @if($image)
        
                        <img class="mb-4" src="{{ $image->temporaryUrl() }}">
                    
                    @else
        
                        <img class="mb-4"pñ src="{{Storage::url($post->image)}}" alt="">
        
                    @endif
        
                    <div class="mb-4">
        
                        <input type="file" wire:model.defer="image" id="{{ $identificador }}">
                        <x-jet-input-error for="image"/>
        
                    </div>
        
                </x-slot>
        
                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$set('open_edit', false)">
                        Cancelar
                    </x-jet-secondary-button>
        
                    <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="image" class="disabled:opacity-25">
                        Actualizar
                    </x-jet-danger-button>
                </x-slot>
        
            </x-jet-dialog-modal>
                

    </div>

    @push('js')
        <script src="sweetalert2.all.min.js"></script>

        <script>

            livewire.on('deletePost', postId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    livewire.emitTo('show-posts', 'delete', postId)

                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })

        </script>
    @endpush

</div>
