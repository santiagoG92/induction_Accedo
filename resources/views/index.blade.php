<x-app title="inicio">
    <section class="my-3 d-flex justify-content-center">

        <h1>Listado de libros</h1>

    </section>

    <section class="d-flex flex-wrap justify-content-center">
        @foreach ($books as $book)

        <div class="card mx-2 my-3  card_size ">

             {{-- <img src="{{ $book->file->route }}" class="card-img-top" alt="Portada Libro"> --}}
             
              <img src="{{ $book->file->route ?? '/storage/images/books/default.png' }}" class="card-img-top" alt="Portada Libro">
            <div class="card-body">
                <h5 class="card-title">{{$book->title}}</h5>
                <p class="card-text">{{$book->format_description}}</p>

                <div class="d-flex flex-wrap">
                    <span class="w-100 mt-2"
                    ><strong>Author: </strong>{{$book->author->name}}
                </span>
                    <span>
                        <strong>Categoria: </strong>{{$book->category->name}}
                    </span>


                </div>

            </div>


            <div class="card-footer">
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-danger">Solicitar</button>
                </div>
            </div>
        </div>

        @endforeach
    </section>
</x-app>
