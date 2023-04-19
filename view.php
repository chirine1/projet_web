<?php
    require 'database.php';

    if(!empty($_GET['id'])) {
        $id = checkInput($_GET['id']);
    }
     
    $db = Database::connect();
    $statement = $db->prepare("SELECT burger_code.items.id, burger_code.items.name, burger_code.items.description,burger_code.items.price, burger_code.items.image, burger_code.categories.name AS category FROM burger_code.items LEFT JOIN burger_code.categories ON burger_code.items.category = burger_code.categories.id WHERE burger_code.items.id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    Database::disconnect();

    function checkInput($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Burger Code</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Holtwood+One+SC'>
    <link rel="stylesheet" href="../css/styles.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code <span
            class="glyphicon glyphicon-cutlery"></span>
    </h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h1><strong>Voir un item</strong></h1>
                <br>
                <form>
                    <div class="form-group">
                        <label>Nom:</label><?php echo '  '.$item['name'];?>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Description:</label><?php echo '  '.$item['description'];?>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Prix:</label><?php echo '  '.number_format((float)$item['price'], 2, '.', ''). ' €';?>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Catégorie:</label><?php echo '  '.$item['category'];?>
                    </div>
                    <br>
                    <div class="form-group<">
                        <label>Image:</label><?php echo '  '.$item['image'];?>
                    </div>
                </form>
                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
                </div>
            </div>
            <div class="col-sm-6 site ">
                <div class="thumbnail">
                    <img src="<?php echo '../images/'.$item['image'];?>" alt="...">
                    <div class="price"><?php echo number_format((float)$item['price'], 2, '.', ''). ' €';?></div>
                    <div class="caption">
                        <h4><?php echo $item['name'];?></h4>
                        <p><?php echo $item['description'];?></p>
                        <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>