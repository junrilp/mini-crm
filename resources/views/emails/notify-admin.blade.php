<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Company</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    </head>

    <body>
        <div class="flex items-center justify-center min-h-screen p-5 bg-gray-600 min-w-screen">
            <div class="max-w-xl p-8 text-center text-gray-800 bg-white shadow-xl lg:max-w-3xl rounded-3xl lg:p-12">
                <h4 class="text-2xl">Hello Administrator,</h4>
                <p><h4>New Company called <span class="text-2xl">{{ $company }}</span> has been added</h4></p>
            </div>
        </div>

    </body>
</html>