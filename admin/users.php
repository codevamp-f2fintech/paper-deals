<?php
// if ($_SESSION['role'] != 1) {
//   header("Location:404.php");
// }
include_once('header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:#fff;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Users </h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php include("message.php"); ?>

          <div class="card">
            <div class="card-header">
              <h3>
                Users
                <?php if ($role == 4) { ?>
                  <a class="btn btn-danger float-sm-right" href="add_admin.php">Add Admin</a>
                <?php } ?>
              </h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>User Name</th>
                    <th>Email Id</th>
                    <th>Phone No.</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <?php if ($_SESSION['role'] == 4 || $_SESSION['role'] == 1) { ?>

                      <th>Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  if ($_SESSION['role'] == 4) {
                    $query = mysqli_query($conn, "Select * from users where user_type=1 ORDER BY id ");
                  } else {
                    $query = mysqli_query($conn, "Select * from users ORDER BY id ");
                  }
                  while ($data = mysqli_fetch_array($query)) {
                    if ($data['user_type'] == 1) {
                      $class = 'badge bg-danger';
                    } else if ($data['user_type'] == 2) {
                      $class = 'badge bg-primary';
                    } else if ($data['user_type'] == 4) {
                      $class = 'badge bg-success';
                    } else if ($data['user_type'] == 5) {
                      $class = 'badge bg-dark';
                    } else if ($data['user_type'] == 6) {
                      $class = 'badge bg-info';
                    } else {
                      $class = 'badge bg-warning';
                    }
                  ?><tr>
                      <td><?= $i; ?></td>
                      <td><?= $data['name']; ?></td>
                      <td><?= $data['email_address']; ?></td>
                      <td><?= $data['phone_no']; ?></td>
                      <td><span class="<?= $class; ?>"><?= IsUser_Role($data['user_type']); ?><span></td>
                      <td><?= date('Y-m-d', strtotime($data['created_on'])); ?></td>
                      <td><?php
                          if ($data["active_status"] == 1) {
                            echo '<a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active  <i class="fa-solid fa-globe" style="color:#1C6C09"></i> </a>';
                          } else {
                            echo '<a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Inactive <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>';
                          }
                          ?></td>
                      <?php if ($_SESSION['role'] == 4 || $role == 1) { ?>

                        <td style="text-align:center;border-bottom:1px solid #f9f9f9;  ">
                          <div class=" dropdown">
                            <?php if ($role == 1 && $data['log_counter'] >= 5) { ?>
                              <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                              </a>
                            <?php } else if ($role == 4) { ?>
                              <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                              </a>
                            <?php  } ?>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                              style=" border:none; ">


                              <?php if ($role == 4) { ?>
                                <?php if ($data['active_status'] == '1') { ?>
                                  <form action="code.php" method="post">
                                    <input type="hidden" name="user_id" value="<?= $data['id']; ?>">
                                    <input type="hidden" name="role"
                                      value="<?= $data['user_type']; ?>">
                                    <li>
                                      <button type="submit" name="deactive_user"
                                        class="dropdown-item">Deactive</button>
                                    </li>
                                  </form>
                                <?php } else { ?>
                                  <form action="code.php" method="post">
                                    <input type="hidden" name="user_id" value="<?= $data['id']; ?>">
                                    <input type="hidden" name="role"
                                      value="<?= $data['user_type']; ?>">
                                    <li>
                                      <button type="submit" name="active_user"
                                        class="dropdown-item">Active</button>
                                    </li>
                                  </form>
                                <?php } ?>
                                <li>
                                  <a href="change_password.php?role=<?php echo $_SESSION['role']; ?>&prod_id=<?= $data['id']; ?>"
                                    name="change_password" class="dropdown-item">Change Password</a>
                                </li>

                            </ul>
                          <?php } else if ($role == 1) { ?>

                            <?php if ($data['log_counter'] >= 5) { ?>
                              <ul>
                                <form action="code.php" method="post">
                                  <input type="hidden" name="user_id" value="<?= $data['id']; ?>">
                                  <input type="hidden" name="role"
                                    value="<?= $data['log_counter']; ?>">
                                  <li style="list-style:none;">
                                    <button type="submit" name="unblock"
                                      class="dropdown-item">Unblock</button>
                                  </li>
                                </form>
                              </ul>
                          <?php }
                              }  ?>

                          </div>
            </div>
            </td>
          <?php } ?>
          </tr>
        <?php $i++;
                  } ?>

        </tbody>
        </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php include_once('footer.php'); ?>