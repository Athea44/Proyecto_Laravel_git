@extends('dashboard.master')
@section('contenido')
    <a class=" btn btn-success mt-3 mb-3" href="{{ route('category.create') }}">
        Crear
    </a>


    <table class="table table-striped">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Fecha de Creacion</td>
                <td>Fecha de Modificacion</td>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }} </td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->created_at->format('d-m-Y') }}</td>
                    <td>{{ $category->updated_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-primary">Ver</a>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Actualizar</a>

                        <button data-toggle="modal" data-target="#deleteModal" data-id="{{ $category->id }}"
                            class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está Seguro que desea borrar la categoria seleccionada?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    <form id="formDelete" action="{{ route('category.destroy', 0) }}" method="POST"
                        data-action="{{ route('category.destroy', 0) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function() {
            $('#deleteModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                console.log(button);
                let id = button.data('id');
                action = $('#formDelete').attr('data-action').slice(0, -1);
                action += id;
                $('#formDelete').attr('action', action);
                let modal = $(this);
                modal.find('.modal-title').text('Vas a borrar la categoria: ' + id);
            });
        };
    </script>
@endsection
