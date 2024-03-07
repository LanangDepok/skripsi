<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Skripsi PNJ</title>
    <style>
        /* * {
            border: 1px solid red;
        } */
    </style>
</head>

<body>
    <header>
        <div class="bg-primary px-8">
            <div class="container mx-auto flex items-center">
                <div>
                    <img src="/storage/assets/logo_pnj.png" class="w-20 h-20">
                </div>
                <div class="ml-3">
                    <h3 class="text-4xl font-semibold text-white">Politeknik Negeri Jakarta</h3>
                </div>
            </div>
        </div>
    </header>

    <div class="flex justify-center mt-32">
        <div class="border-2 border-primary w-1/4 h-80 rounded-lg shadow-lg shadow-slate-400 p-10">
            <form method="POST" action="/login">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <br>
                    <input type="email" id="email" name="email"
                        class="w-full rounded-md border border-primary focus:bg-red-100 hover:bg-red-100">
                </div>
                <div class="mt-8">
                    <label for="password">Password</label>
                    <br>
                    <input type="password" id="password" name="password"
                        class="w-full rounded-md border border-primary focus:bg-red-100 hover:bg-red-100">
                </div>
                <div class="mt-6">
                    <label for="show">Show</label>
                    <input type="checkbox" id="show" onclick="myFunction()">
                </div>
                <div class="mt-10 flex justify-center">
                    <button type="submit"
                        class="bg-primary w-24 h-8 rounded-2xl hover:bg-red-300 text-white">Login</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="absolute w-full bottom-0">
        <div class="bg-slate-400 container text-center">
            <p class="text-sm">Copyright &copy; - Designed & Developed by Politeknik Negeri Jakarta</p>
        </div>
    </footer>

    <script>
        function myFunction() {
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
</body>

</html>
