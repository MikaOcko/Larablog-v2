<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article n°') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="wrapper max-w-2xl mx-auto my-2 p-4 sm:p-6 lg:p-8 bg-gray-50 rounded-b-md shadow-lg overflow-hidden">
            <h1 class="font-semibold">{{ $article->title }}</h1>

            <img src="{{ asset('storage/'.$article->picture) }}" alt="Image de couverture" style="max-width: 300px;">

            <div>{{ $article->content }}</div>

            <x-primary-button>
                <a href="{{ route('articles.index') }}" title="Retourner aux articles" >Retourner aux articles</a>
            </x-primary-button>
        </div>





        {{-- Commentaires --}}

        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <h1 class="font-semibold">Commentaires</h1>
        </br>
            <form method="POST" action="{{ route('posts.store', ["article_id" => $article->id]) }}">
                @csrf
                <textarea
                    name="message"
                    placeholder="{{ __('What\'s on your mind?') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('message') }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Comment') }}</x-primary-button>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

                @foreach ($article->posts as $post)
                    <x-post-card :$post/>
                @endforeach
            </div>
        </div>




    </x-slot>
</x-app-layout>