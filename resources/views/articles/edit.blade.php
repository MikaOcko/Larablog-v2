<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tous les articles') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <h1 class="font-semibold">Editer un article</h1>

            <!-- Si nous avons un article $article -->
	        @if (isset($article))
            <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data" >
                <!-- <input type="hidden" name="_method" value="PUT"> -->
                @method('PUT')
            
                @csrf
                            
                <p>
                    <label for="title" >Titre</label><br/>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}"  id="title" placeholder="Le titre du article" >
            
                    <!-- Le message d'erreur pour "title" -->
                    @error("title")
                    <div>{{ $message }}</div>
                    @enderror
                </p>
            
                <p>
                    <label for="picture" >Couverture</label><br/>
                    <input type="file" name="picture" id="picture" >
            
                    <!-- Le message d'erreur pour "picture" -->
                    @error("picture")
                    <div>{{ $message }}</div>
                    @enderror
                </p>
            
                <p>
                    <label for="content" >Contenu</label>
                    <br/>
            
                    <textarea name="content" id="content" lang="fr" rows="10" cols="50" placeholder="Le contenu du article" >{{ old('content', $article->content)}}</textarea>
                       <!-- Le message d'erreur pour "content" -->
                    @error("content")
                    <div>{{ $message }}</div>
                    @enderror
                </p>
            
                <x-primary-button>
                    <input type="submit" name="valider" value="Valider" >
                </x-primary-button>
            </form>

            @else

            <!-- Le formulaire est géré par la route "articles.store" -->
            <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" >
            
           
                <!-- Le token CSRF -->
                @csrf
                
                <p>
                    <label for="title" class="font-semibold">Titre</label><br/>
                    <input type="text" name="title" id="title" placeholder="Le titre du article" >

                    <!-- Le message d'erreur pour "title" -->
                    @error("title")
                    <div class="font-bold text-red-700">{{ $message }}</div>
                    @enderror
                </p>

                <p>
                    <label for="picture" class="font-semibold">Couverture</label><br/>
                    <input type="file" name="picture" id="picture" >

                    <!-- Le message d'erreur pour "picture" -->
                    @error("picture")
                    <div class="font-bold text-red-700">{{ $message }}</div>
                    @enderror
                </p>

                <p>
                    <label for="content" class="font-semibold">Contenu</label>
                    <br/>
                    <textarea name="content" id="content" lang="fr" rows="10" cols="50" placeholder="Le contenu du article" ></textarea>
     
                    <!-- Le message d'erreur pour "content" -->
                    @error("content")
                    <div class="font-bold text-red-700" >{{ $message }}</div>
                    @enderror
                </p>

                <x-primary-button>
                    <input type="submit" name="valider" value="Valider" >
                </x-primary-button>

            </form>
            @endif

        </div>
    </x-slot>
</x-app-layout>