<?php require_once 'process.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Php Crud</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    
  </head>
  <body>

    <?php if (isset($_SESSION['message'])): ?>
    
    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php  
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>  
  <div class="container">
    <?php
        //$mysqli = new mysqli('localhost', 'root', '', 'php_crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    ?>

    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>

    <?php
      while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['location']; ?></td>
          <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');">Delete</a>
          </td>
        </tr>
    <?php endwhile; ?>
      </table>    
    </div>
    <div class="row justify-content-center">
      <form action="process.php" method="POST"> <!-- Include php file to process data -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
        </div>

        <div class="form-group">
        <label>Location</label>
        <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your location">
        </div>

        <div class="form-group">
        <?php
        if ($update == true):
        ?>
            <button type="submit" class="btn btn-info" name="update">Update</button>
        <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>
        </div>
      </form>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>