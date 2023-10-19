<div>

    {{-- <x-button class="mb-4" wire:click="$set('count', 0)">
        Resetear
    </x-button> --}}
    <x-button class="mb-4" wire:click="$toggle('open')">
        Mostar / Ocultar
    </x-button>


   
    <form class="mb-4" wire:submit="save">
        <x-input wire:model="pais" 
        placeholder="Agregue su pais" 
        wire:keydown.space="increment" />

        <x-button wire:click>
            Agregar
        </x-button>
    </form>
    @if ($open) 
    <ul class="list-disc list-inside space-y-2">
        @foreach ($paises as $index => $pais)
            <li wire:key="pais-{{ $index }}">
                
                <span class="cursor-pointer" wire:mouseenter="changeActive('{{ $pais }}')">({{ $index }}){{ $pais }}</span>

                 <x-danger-button wire:click='delete({{ $index }})'>
                  {{--  hacemos referencia al indice, para que sepa que esta eliminando --}}
                    x
                </x-danger-button>

            </li>
        @endforeach
    </ul>
@endif
 {{-- {{ $count }} --}}
</div>
