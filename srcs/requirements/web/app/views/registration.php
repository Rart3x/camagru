<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Camagru</title>

        <link rel="stylesheet" href="../../style/main.css">

        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/daisyui@^1.3.6/dist/full.css" rel="stylesheet">
    </head>
    <body>
        <main class="mx-auto flex min-h-screen w-full items-center justify-center bg-gray-900 text-white" >
            <section class="flex w-[30rem] flex-col space-y-10">
                <div class="text-center text-4xl font-medium">Register</div>
                    <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500" >
                        <input type="text" name="username" placeholder="E-mail" class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />
                    </div>
                
                    <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500" >
                        <input type="password" name="password" placeholder="Password" class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />
                    </div>

                    <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500" >
                        <input type="password" name="confirmPass" placeholder="Confirm Password" class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />
                    </div>

                    <button class="transform rounded-sm bg-indigo-600 py-2 font-bold duration-300 hover:bg-indigo-400" type="submit"> LOG IN </button>
                
                    <p class="text-center text-lg"> Already registered ? <a href="<?=PROOT?>login" class="font-medium text-indigo-500 underline-offset-4 hover:underline">Log in</a > </p>
                </form>
            </section>
        </main>

    </body>
</html>