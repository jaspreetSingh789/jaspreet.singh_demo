<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section>
        <div>
            <form action="{{ route('users.savepassword',$user) }}" method="post">
                @csrf
                <label for="password">Password</label>
                <input class="border border-grey-400 p-2 w-full mb-2" type="password" name="password">
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <button type="submit">Send</button>
            </form>
        </div>
    </section>
</body>

</html>