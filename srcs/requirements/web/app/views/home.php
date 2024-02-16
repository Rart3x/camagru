<!DOCTYPE html>
<html data-theme="retro" lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Camagru</title>

        <link rel="stylesheet" href="<?php ROOT . DS . 'style' . DS . 'main.css' ?>">

        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/daisyui@^1.3.6/dist/full.css" rel="stylesheet">
    </head>
    <body>
        <header class="text-white p-4">
            <nav>
                <ul>
                    <div class="align-center">
                        <button><a href="#home" class="btn btn">Home</a></li>
                        <button><a href="#about" class="btn btn-secondary">About</a></li>
                        <button><a href="#gallery" class="btn btn-accent">Galery</a></li>
                    </div>
                </ul>
            </nav>
        </header>
        <div class="left-part">
            <p>left</p>
        </div>
        <div class="center-part">
            <div class="center-part-header">
                <div class="center-part-header-left">
                    <img src="assets/default_pic.jpg" alt="default pic">
                </div>
                <div class="center-part-header-center">
                    <input type="text" placeholder="What's up ?">
                </div>
                <div class="center-part-header-right">
                    <img src="assets/gallery.jpg" alt="gallery pic">
                    <button type="submit">Post</button>
                </div>
            </div>
            <p>center</p>
        </div>
        <div class="right-part">
            <p>right</p>
        </div>

         <footer class="bg-gray-800 text-white p-4">
            <p class="text-center">&copy; Rart3x</p>
            <p>footer</p>
        </footer>
    </body>
</html>