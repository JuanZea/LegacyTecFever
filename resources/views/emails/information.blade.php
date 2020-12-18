<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  <body style="background-color: cyan">
    <div class="container pt-4 bg-primary">
        <div class="row justify-content-center">
            <div class="alert alert-warning shadow">
                <h1>{{ strtoupper(trans('this is what we know about you')) }}</h1>
            </div>
        </div>
        <div class="row text-white">
            <div class="col">
                @if ($user->name != null)
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('name')).': ' }}</b><br>{{ ucwords($user->name) }}</p>
                @else
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('name')).': ' }}</b><br>{{ ucfirst(trans('we do not know')).' ¯\_(ツ)_/¯' }}</p>
                @endif

                @if ($user->surname != null)
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('surname')).': ' }}</b><br>{{ ucwords($user->surname) }}</p>
                @else
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('surname')).': ' }}</b><br>{{ ucfirst(trans('we do not know')).' ¯\_(ツ)_/¯' }}</p>
                @endif

                @if ($user->document_type != null)
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('document type')).': ' }}</b><br>{{ ucwords($user->document_type) }}</p>
                @else
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('document type')).': ' }}</b><br>{{ ucfirst(trans('we do not know')).' ¯\_(ツ)_/¯' }}</p>
                @endif

                @if ($user->document != null)
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('document')).': ' }}</b><br>{{ ucwords($user->document) }}</p>
                @else
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('document')).': ' }}</b><br>{{ ucfirst(trans('we do not know')).' ¯\_(ツ)_/¯' }}</p>
                @endif

                @if ($user->mobile != null)
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('mobile')).': ' }}</b><br>{{ ucwords($user->mobile) }}</p>
                @else
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('mobile')).': ' }}</b><br>{{ ucfirst(trans('we do not know')).' ¯\_(ツ)_/¯' }}</p>
                @endif

                @if ($user->email != null)
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('email')).': ' }}</b><br>{{ ucwords($user->email) }}</p>
                @else
                    <p class="display-4 bg-info p-3 rounded shadow"><b>{{ ucfirst(trans('email')).': ' }}</b><br>{{ ucfirst(trans('we do not know')).' ¯\_(ツ)_/¯' }}</p>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="alert alert-warning shadow">
                <h1>{{ ucfirst(trans('sincerely TecFever')) }}</h1>
            </div>
        </div>
    </div>
  </body>
</html>
