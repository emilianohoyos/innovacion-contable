@extends('layouts.master')

@section('title', 'Carpeta del Cliente')
@section('css')
    <link href="{{ URL::asset('dist/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <x-page-title title="Carpeta del Cliente" pagetitle="Carpeta del Cliente" />


    <div class="row row-cols-1 row-cols-xl-2">
        @foreach ($folders as $item)
            <div class="col">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4 border-end">
                            <div class="p-3 text-center d-flex flex-column align-items-center justify-content-center"
                                style="height: 100%;">
                                <i class="material-icons-outlined rounded-start p-1 border"
                                    style="font-size: 90px; color: #ffcc00;">folder</i>
                                <h5 class="card-title mt-2">{{ $item->folder->name }}</h5>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Es nuevo</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->folder->ApplyDocTypeFolders as $applyDocTypeFolder)
                                                @foreach ($applyDocTypeFolder->monthlyAccountingFolderApplyDocTypeFolders as $archive)
                                                    <tr>
                                                        <th>{{ $archive->is_new == true ? 'SI' : 'NO' }}</th>
                                                        <th>{{ $archive->status }}</th>
                                                        <th> <button type="button"
                                                                class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                                                                onclick="downloadFile({{ $archive->id }})">
                                                                <i class="material-icons-outlined">visibility</i>
                                                            </button> </th>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Es nuevo</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="row g-0">

                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
@section('scripts')
    <script>
        function downloadFile(id) {
            // Define la URL del endpoint
            const url = "{{ route('file.download') }}";

            // Realiza la solicitud POST
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        id: id
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error ${response.status}: ${response.statusText}`);
                    }
                    return response.blob(); // Obtiene el contenido como un Blob
                })
                .then(blob => {
                    // Crea un enlace para descargar el archivo
                    const link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = fileName; // Nombre del archivo descargado
                    link.click();
                })
                .catch(error => {
                    console.error('Error al descargar el archivo:', error);
                });
        }
    </script>
@endsection
