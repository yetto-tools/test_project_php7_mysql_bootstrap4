<?php
/*
 * php-crud.php
 *
 * Copyright 2020 erick <erick@linux>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */

/*
 *   INSERT:
 *   INSERT INTO table (col1, col2) values ('val1', val2);
 *
 *
 *   SELECT:
 *   SELECT * FROM table WHERE col1 = 'val1' AND col2 ='val2';
 *
 *
 *   UPDATE:
 *   UPDATE  table SET col1= 'val1', col2 = 'val2' WHERE col3 = 'val3';
 *
 *   DELETE:
 *   DETELE FROM table WHERE col1 = 'val1'
 *
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<head>
    <title>untitled</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.32" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <?php include ('process.php');//require_once () 'process.php'; ?>

    <?php
    if(isset($_SESSION['message'])):  ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
    ?>
  <?php endif; ?>
    </div>
<div class="container">
  <?php
      $mysqli = new mysqli('db', 'root', 'test', 'sampledb') or die(mysqli_err($mysqli));
      //$result = $mysqli->query("SELECT * FROM users ORDER BY registration_date DESC LIMIT 3;") or die ($mysqli->error);
      $result = $mysqli->query("SELECT * FROM users") or die ($mysqli->error);
  ?>
    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Create Date</th>
          </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()):  ?>
            <tr>
              <td> <?php echo $row['userid']  ?></td>
              <td> <?php echo $row['first_name']  ?></td>
              <td> <?php echo $row['last_name']  ?></td>
              <td> <?php echo $row['email']  ?></td>
              <td> <?php echo $row['registration_date']  ?> </td>
              <td>
                <a href="php_crud.php?edit=<?php echo $row['userid']; ?>" class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['userid']; ?>" class="btn btn-danger">Detele</a>
              </td>

          <?php endwhile; ?>
            </tr>
      </table>
    </div>


    <div class="row justify-content-center">
    <form action="process.php" method="POST">
        <input type="hidden" name="userid" value="<?php echo $userid;?>">
        <div class= "from-group">
          <label>Name</label>
          <input type="text" name="first_name" class="form-control" value="<?php echo $first_name;?>" placeholder="Name">
        </div>
        <div class= "from-group">
          <label>Last Name</label>
          <input type="text" name="last_name" class="form-control" value="<?php echo $last_name;?>" placeholder="Last Name">
        </div>
        <div class= "from-group">
          <label>email</label>
          <input type="text" name="email" class="form-control" value="<?php echo $email;?>" placeholder="Email">
        </div>

        <div class= "from-group">
          <label>Password</label>
          <input type="password" name="passwd" class="form-control" placeholder="Password">
        </div>

        <div class= "from-group">
          <?php if ($update == true): ?>
          <button type="submit" class="btn btn-primary" name="update">Update</button>
        <?php else: ?>
          <button type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>
        </div>
    </form>
    </div>
    </div>

</body>

</html>
