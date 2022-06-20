<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <section>
        <div class="main w-3/5 mx-auto mt-10 border border-gray-200 p-6 bg-gray-200 rounded-xl">
            <h1 class="font-bold text-xl mb-10">Set New Password</h1>
            <form action="{{ route('users.savepassword',$user) }}" method="post">
                @csrf
                <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="password">Password</label>
                <input class="border border-grey-400 p-2 w-full mb-2" type="password" name="password">
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="confirm_password">Confirm Password</label>
                <input class="border border-grey-400 p-2 w-full mb-2" type="password" name="confirm_password">
                @error('confirm_password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <button type="submit" class=" bg-blue-400 text-white rounded px-4 py-2 hover:bg-blue-500 ">Send</button>
            </form>
        </div>
    </section>
</body>

</html>