<!DOCTYPE html>
<html lang="en">

<head>
    <title>Burger Code</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Holtwood+One+SC" />
    <link rel="stylesheet" href="css/styles.css" />
    <link href="http://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>

<body>
    <div class="container site">
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span> Burger Code
            <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        <?php
        require 'admin/database.php';
        echo '<nav>
        <ul class="nav nav-pills">';
        $db = Database::connect();
        $statment = $db->query('SELECT * FROM burger_code.categories');
        $categories = $statment->fetchAll();
        foreach ($categories as $category) {
            if ($category['id'] == '1')
                echo '<li role="presentation" class="active">
            <a href="#1"' . $category['id'] . '"data-toggle="tab">' . $category['name'] . '</a></li>';
            else
                echo '<li role="presentation "><a href="#' . $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a></li>';
        }
        echo '</ul>
        </nav>';
        echo '<div class="tab-content">';
        foreach ($categories as $category) {
            if ($category['id'] == '1')
                echo '<div class="tab-pane active" id="' . $category['id'] . '">';
            else
                echo ' <div class="tab-pane " id="' . $category['id'] . '">';
            echo '<div class="row">';
            $statment = $db->prepare('SELECT* FROM burger_code.items WHERE burger_code.items.category=?');
            $statment->execute(array($category['id']));
            while ($item = $statment->fetch()) {
                echo ' <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="images/' . $item['image'] . '" alt="..." >
                <div class="price">' . number_format($item['price'], 2, '.', '') . ' €</div>
                <div class="caption">
                    <h4>' . $item['name'] . '</h4>
                    <p>' . $item['description'] . ' </p>
                    <a href="#" class="btn btn-order" role="button"><span
                            class="glyphicon glyphicon-shopping-cart"></span>
                        Commander</a>
                </div>
            </div>
        </div>';
            }
            echo '</div>
           </div>';
        }
        Database::disconnect();
        echo '</div>';
        ?>
    </div>
</body>

</html>