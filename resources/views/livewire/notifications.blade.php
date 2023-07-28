<div class="ml-3 relative">
    <x-dropdown align="right" width="64">
        <x-slot name="trigger">
            
            <span class="inline-flex rounded-md">
                <button wire:click="resetNotification()" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                    Notificaciones

                    <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-1 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
                        {{ auth()->user()->notification }}
                    </div>
                    
                </button>
            </span>
            
        </x-slot>

        <x-slot name="content">

           <div class="max-h-[calc(100vh-8rem)] overflow-auto">
                @if ($this->notifications->count())
                
                    <ul class="divide-y">
                        @foreach ($this->notifications as $notification)

                            <li @class(['bg-gray-200' => $notification->read_at]) wire:click="readNotification('{{ $notification->id }}')">
                                <x-dropdown-link href="{{ $notification->data['url'] }}">
                                    {{ $notification->data['message'] }}

                                    <br>

                                    <span class="text-xs font-semibold">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                </x-dropdown-link>
                            </li>

                        @endforeach
                    </ul>

                    @if(auth()->user()->notifications->count() > $count)
                        <div class="px-4 mx-1 mt-2 mb-1 flex justify-center bg-purple-500 hover:bg-purple-400 rounded-xl py-2 text-white">
                            <button wire:click="incrementCount()" class="text-sm">
                                Ver más notificaciones
                            </button>
                        </div>
                    @endif

                @else
                    
                    <div class="px-4 py-2">
                        No tiene notificaciones
                    </div>

                @endif
            </div>

        </x-slot>
    </x-dropdown>
</div>
