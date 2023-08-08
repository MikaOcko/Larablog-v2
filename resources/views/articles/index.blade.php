<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tous les articles') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="max-w-2xl mx-auto p-4">
            
            @auth
            <x-primary-button>
                <!-- Lien pour créer un nouvel article : "articles.create" -->
                <a href="{{ route('articles.create') }}" title="Créer un article" >Créer un nouvel article</a>
            </x-primary-button>
            @endauth
            
            
            <section class="flex justify-center items-center p-2 gap-4">
                <!-- Affichage de tous les articles : pour chaque article (articles.*) -->
                @foreach ($articles as $article)
                    <div class="wrapper max-w-xs bg-gray-50 rounded-b-md shadow-lg overflow-hidden">
                        {{-- Image de couverture de l'article--}}
                        <div>
                            @if ($article->picture)
                                <img src="{{ asset('storage/'.$article->picture) }}" alt="Image de couverture" style="max-width: 50%;">
                            @else
                                <img src="https://cdn.pixabay.com/photo/2016/05/24/16/48/mountains-1412683_1280.png" alt="montagne" />
                            @endif
                        </div>

                        <div class="p-3 space-y-3">
                            {{-- Titre de l'article --}}
                            <h3>
                                <!-- Lien pour afficher un article : "articles.show" -->
                                <a href="{{ route('articles.show', $article) }}" title="Lire l'article" class="font-semibold">{{ $article->title }}</a>
                            </h3>

                            {{-- contenu de l'article - premières phrases --}}
                            <p class="text-sm text-gray-900 leading-sm">
                                {{$article->content}}
                            </p>
                            
                            @auth
                            <div>
                                <x-primary-button>
                                    <!-- Lien pour modifier un article : "articles.edit" -->
                                    <a href="{{ route('articles.edit', $article) }}" title="Modifier l'article" >Modifier</a>
                                </x-primary-button>
                                
                                <x-danger-button>
                                    <!-- Formulaire pour supprimer un article : "articles.destroy" -->
                                    <form method="POST" action="{{ route('articles.destroy', $article) }}" >
                                        <!-- CSRF token -->
                                    @csrf
                                    <!-- <input type="hidden" name="_method" value="DELETE"> -->
                                    @method("DELETE")
                                    <input type="submit" value="Supprimer" >
                                    </form>
                                </x-danger-button>
                            </div>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </x-slot>
</x-app-layout>