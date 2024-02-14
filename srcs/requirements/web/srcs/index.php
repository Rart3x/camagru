<?php
    // session_start();

    // define('DS', DIRECTORY_SEPARATOR);
    // define('ROOT', dirname(__FILE__));

    // $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

    // require_once(ROOT . DS . 'core' . DS . 'boostrap.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Camagru</title>

        <link rel="stylesheet" href="style/main.css">

        <!-- Tailwind CSS and DaisyUI CDN -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/daisyui@^1.3.6/dist/full.css" rel="stylesheet">
    </head>
    <body>
        <header class="bg-blue-500 text-white p-4">
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#home" class="btn btn-primary">Home</a></li>
                    <li><a href="#about" class="btn btn-secondary">About</a></li>
                    <li><a href="#contact" class="btn btn-accent">Contact</a></li>
                </ul>
            </nav>
        </header>
        <main class="container mx-auto p-8">
            <section id="home">
                <h1 class="text-4xl font-bold text-center my-8">Camagru</h1>
            </section>
        </main>

        <footer class="bg-gray-800 text-white p-4">
            <p class="text-center">&copy; <?php echo date("Y"); ?> Rart3x</p>
        </footer>
    </body>
</html>