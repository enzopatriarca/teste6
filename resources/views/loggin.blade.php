<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Loggin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/styles.css">


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
    
    <div class="text-center">

        <img class="mt-4 mb-4" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Logo_Itaipu_Preferencial.svg/1200px-Logo_Itaipu_Preferencial.svg.png" height="80px" alt="Logo_Itaipu">
            <h1 class="titulo_1">SITT.AA - Troubleshoting Switch Bandwidth Meter</h1>
            <h3 class="log">LOGGIN</h3>

        <form style="width: 500px; margin:auto;" method="POST" action="{{route('auth.user')}}">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @if(session('danger'))

                <div class="alert alert-danger">
                    {{session('danger')}}
                </div>

            @endif

            @csrf
            

            <div class="mt-4">
                <label class="titulo_2" for="Username"> Enter Username:</label>
                <input style="border-color: black;" type="text" class="form-control" size="10px" id="username" placeholder="Username" name="username">
            </div>
            


            <div class="mt-4">
                <label class="titulo_2" for="pass"> Enter Password:</label>

                    <input style="border-color: black;" type="password" class="form-control" size="10px" id="password" placeholder="password" name="password">                           
            </div>

            <div class=" mt-3">
                <button class="btn_1" class="btn btn-lg btn-primary">Sign in </button>

            </div>


        </form>
    </div>    

       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>


    
</html>

