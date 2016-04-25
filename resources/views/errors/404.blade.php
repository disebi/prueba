@extends('app2')

@section('bread')
          <h1>
            Error 404 Pagina No encontrada
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li><a href="#">Error</a></li>
            <li class="active">404 error</li>
          </ol>

@endsection
@section('content')


        <!-- Main content -->
        <section class="content">
          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Pagina no encontrada.</h3>
              <p>
                No pudimos encontrar la pagina que esta buscando.
                Mientras tanto, puede <a href="/">volver al linicio</a> o puede buscar en
              </p>
              <form class="search-form">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Buscar">
                  <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                  </div>
                </div><!-- /.input-group -->
              </form>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
@endsection
