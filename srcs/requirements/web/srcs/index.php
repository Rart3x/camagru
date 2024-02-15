<?php
    session_start();

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(__FILE__));

    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
    
    require_once(ROOT . DS . 'core' . DS . 'Router.php');
    require_once(ROOT . DS . 'core' . DS . 'boostrap.php');
    require_once(ROOT . DS . 'core' . DS . 'DB.php');

    $db = DB::getInstance();
    $sql = "CREATE TABLE IF NOT EXISTS `test` (
        `name` varchar(255) NOT NULL,
        `age` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $db->query($sql);
    $sql = "INSERT INTO `test` (`name`, `age`) VALUES ('dams', '22');";
    $db->query($sql);
?>

<!DOCTYPE html>
<html data-theme="retro" lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Camagru</title>

        <link rel="stylesheet" href="style/main.css">

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

         <!-- <footer class="bg-gray-800 text-white p-4">
            <p class="text-center">&copy; Rart3x</p>
            <p>footer</p>
        </footer> -->
    </body>
</html>