<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Commentaires') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <h1 class="font-semibold">Modifier un commentaire</h1>
        </br>
            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf
                @method('patch')
                <textarea
                    name="message"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('message', $post->message) }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />

                <div class="mt-4 space-x-2">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    <x-secondary-button>
                        <a href="{{ route('posts.index') }}">{{ __('Cancel') }}</a>
                    </x-secondary-button>
                </div>
            </form>
        </div>
    </x-slot>

</x-app-layout>