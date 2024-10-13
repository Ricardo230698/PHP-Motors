<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhancement 1</title>
    <link rel="stylesheet" href="/phpmotors/css/index.css">
</head>
<body>
    
    <div id="content">

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/header.php';
        // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/nav.php';
        echo $navList;
    ?>

    <main>
        <h1>Welcome to PHP Motors!</h1>
        
        <section id="first">
            <h2>DMC Delorean</h2>
            <p id="flotar">3 Cup holders<br>
            Superman doors<br>
            Fuzzy dice!</p>
            <!-- <img id="main-auto" src="../phpmotors/images/delorean.jpg" alt="auto"> -->
            <img id="main-auto" src="../phpmotors/images/vehicles/delorean.jpg" alt="auto">
            <img id="main-btn" src="../phpmotors/images/site/own_today.png" alt="own_today">

        </section>

        <section id="second">
            <div id="reviews">
                <h2>DMC Dolorean Reviews</h2>
                <ul id="reviews-list">
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </div>

            <div id="boxes">
                <h2>Delorean Upgrades</h2>

                <div id="box-1">
                    <div>
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux">
                    </div>
                    <a href="#">Flux Capacitor</a>
                </div>

                <div id="box-2">
                    <div>
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame">
                    </div>
                    <a href="#">Flame Decals</a>
                </div>

                <div id="box-3">
                    <div>
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper">
                    </div>
                    <a href="#">Bumper Stickers</a>
                </div>

                <div id="box-4">
                    <div>
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub">
                    </div>
                    <a href="#">Hub Caps</a>
                </div>

            </div>
        </section>

    </main>

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/footer.php';
    ?>

    </div>


</body>
</html>