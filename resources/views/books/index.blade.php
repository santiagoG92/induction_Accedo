<x-app title="Libros">
    <section class="container">
<div class=" d-flex my-4 justify-content-center">
    Listado De Libros</div>

<the-book-list :books="{{$books}}" :authors_data="{{$authors}}"/>
    </section>
</x-app>