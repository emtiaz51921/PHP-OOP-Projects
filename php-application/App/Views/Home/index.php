<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
</head>

<body>
    <h1>Welcome <?php echo htmlspecialchars( $name ); ?></h1>
    <ul>
        <?php

            foreach ( $colors as $color ) {
                echo "<li>$color</li>";
            }

        ?>
    </ul>
</body>

</html>