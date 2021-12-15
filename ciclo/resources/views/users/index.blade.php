<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="raw">
            <div class="col-sm-8 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                              -  {{$error}}     <br>                           
                            @endforeach
                        </div>
                            
                        @endif
                        <form action="{{ route('user.store') }}" method="POST">

                            <div class="form-row" style="display: flex;">
                                <div class="col-sm-3">
                                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{old('name')}}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="email" class="form-control" placeholder="Email" value=" {{old('email')}} ">
                                </div>
                                <div class="col-sm-3">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Contraseña">
                                </div>
                                <div class="col-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>


                            </div>
                    </div>

                    </form>


                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>nombre</th>
                            <th>Email</th>
                            <th> &nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th> {{ $user->id }}</th>
                                <th> {{ $user->name }}</th>
                                <th> {{ $user->email }}</th>
                                <th>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" value="Eliminar" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¡¿desea eliminar?..')">
                                    </form>
                                </th>

                            </tr>

                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>

</body>

</html>
