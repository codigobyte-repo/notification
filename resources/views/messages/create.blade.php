<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mensajes
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8 px-8">
                
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf

                    <x-validation-errors class="mb-4" />

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Destinatario
                        </x-label>
                        
                        <select name="recipient_id" class="form-control w-full">
                            @foreach ($users as $user)
                                <option @selected(old('recipient_id') == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Asunto
                        </x-label>
                        <x-input name="subject" value="{{ old('subject') }}" type="text" class="w-full" placeholder="Asunto del mensaje" />
                    </div>

                    <div class="mb-4">
                        <x-label class="mb-1">
                            Mensaje
                        </x-label>
                        <textarea name="body" class="form-control w-full" placeholder="Escriba su mensaje">{{ old('body') }}</textarea>
                    </div>

                    <div class="flex justify-end">

                        <x-button>Enviar</x-button>

                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>