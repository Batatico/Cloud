<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Web Seguimiento y Evaluación de Ayudantes') }}
        </h2>
    </x-slot>

    <section class=" container py-1 mt-1 justify-content-center", style="padding-top:60px; ">
        <div>
            <div class="row justify-content-center">
                <div class="card justify-content-center">
                    <div class="card-header py-2 mt-2 text-center justify-content-center">
                       <h3> --Puede realizar las siguientes actividades-- </h3>

                    </div>
                    <div class= "d-flex card-body py-4 mt-4 justify-content-between">
                        <button class="btn btn-primary btn-lg" type="button" onclick="window.location='{{ url("/import-contenedor-asignatura") }}'">Ingresar como Administrador</button>
                        <button class="btn btn-primary btn-lg" type="button" onclick="window.location='{{ url("/import-alumno") }}'">Ingresar como Docente</button>
                        <button class="btn btn-primary btn-lg" type="button" onclick="window.location='{{ url("/import-asignatura") }}'">Ingresar como Alumno</button>
                        <button class="btn btn-primary btn-lg" type="button" onclick="window.location='{{ url("/import-ayudante") }}'">Ingresar como Ayudante</button>
                        

                        

                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
