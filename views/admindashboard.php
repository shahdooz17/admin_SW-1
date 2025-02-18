<?php
session_start();
include '../include/headeradmin.php';
if($_SESSION['username'] && $_SESSION['userRole'] === "Admin")
{
?>
    <section class="overlay"></section>
      <div class="fresh-table full-color-blue">
        <table id="fresh-table" class="table">

        <thead>
          <th data-field="id">ID</th>
          <th data-field="name">Username</th>
          <th data-field="salary">Email</th>
          <th data-field="country">UserRole</th>
          <th data-field="city">PhoneNumber</th>
          <th>Actions</th>
        </thead>

        <tbody>  
          

<?php


          $data = $admin->displayUsers();
          foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . $row['UserID']        . '</td>';
            echo '<td>' . $row['Username']        . '</td>';
            echo '<td>' . $row['Email']        . '</td>';
            echo '<td>' . $row['UserRole']        . '</td>';
            echo '<td>' . $row['PhoneNumber']        . '</td>';
          
            ?>
                  <td>
                      <form action="<?php echo APPURL ?>/controllers/AdminController.php" method="POST">
                        <button type="submit" name="user_delete" value="<?= $row["UserID"]; ?>" class="btm btn-danger">Delete</button>
                      </form>
                  </td>

                    <?php

            echo '</tr>';


          }
          ?>
        </tbody>
      </table>
    </div>



  </div>
    <div class="container" id="container">
      <div class = "center">
        <div class="form-container signup-container">
            <form method="post" action="<?php echo APPURL ?>/controllers/AdminController.php">
                <h1>Add user</h1>
                <input type="text" placeholder="First name" name="firstname" required />
                <input type="text" placeholder="Last name" name="lastname" required />
                <input type="tel" placeholder="Phone number" name="phonenumber" required />
                <input type="email" placeholder="Email" name="email" title="Make sure to enter a valid email" required />
            <div>
            </div>
                <div>
                    <label for="Admin">
                        <input type="radio" name="userRole" value="Admin" id="Admin" style="max-width: min-content;" />Admin</label>
                </div>
                <button type="submit" name="add_user">Add</button>
            </form>
        </div>
      </div>
    </div>
<?php
include '../include/footeradmin.php';
}
else {
  header("Location:../../index.php");
}
?>