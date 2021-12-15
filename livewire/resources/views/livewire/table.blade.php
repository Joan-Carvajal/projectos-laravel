<h2 class="text-center text-4xl font-semibold   ">Listado de Posts</h2>

<table class="mx-20 bg-white mt-10 rounded-lg px-20">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Contenido</th>
            <th colspan="2">&nbsp;</th>

        </tr>

    </thead>
    <tbody>
        @foreach ( $posts as $post )
        <tr>
            <td class="p-2">{{$post->id}}</td>
            <td class="mx-3 w-2/4">{{$post->title}}</td>
            <td class="w-2/4"> {{$post->body}}</td>
            <td>
                <button wire:click="edit({{$post->id}})" class="bg-blue-700 rounded-lg px-3 py-2 text-blue-300">
                    Editar
                </button>

            </td>
            <td><button wire:click="destroy({{ $post->id }})" class="bg-red-700 rounded-lg px-3 py-2 text-red-300">
                Eliminar
            </button></td>


        </tr>
        @endforeach

    </tbody>

</table>
<div class="mx-20">
{{$posts->links()}}

</div>
