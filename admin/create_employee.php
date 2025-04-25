<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    Employee Information
                                    <a href="employee.php" class="btn btn-danger float-right">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employee Name</label>

                                            <input type="text" name="employee_name" class="form-control" required
                                                placeholder="Employee Name">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>User Type</label>
                                            <select name="user_type" class="form-control">
                                                <option>--User Type--</option>
                                                <option>Admin</option>
                                                <option>Buyer</option>
                                                <option>Seller</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>DOB</label>
                                            <div class="input-group date" id="datemask" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#datemask" placeholder="DD-MM-YY" />
                                                <div class="input-group-append" data-target="#datemask"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Gender</label>
                                            <select name="gender" class="form-control">
                                                <option>--Select Gender--</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date of Joining</label>
                                            <div class="input-group date" id="dateofjoin" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#dateofjoin" placeholder="DD-MM-YY" />
                                                <div class="input-group-append" data-target="#dateofjoin"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email ID</label>
                                            <input type="email" name="email" class="form-control" required
                                                placeholder="Email ID">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>POA</label>
                                            <input type="text" name="poa" class="form-control" required
                                                placeholder="POA">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>POI</label>
                                            <input type="text" name="poi" class="form-control" required
                                                placeholder="POI">
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Login Credential
                                </h4>
                            </div>
                            <div class="card-body">


                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Login ID</label>

                                            <input type="text" name="login_id" class="form-control" required
                                                placeholder="Login ID">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" required
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option>Active</option>
                                                <option>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Photo
                                </h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Profile picture size width: 396px, width: 269px </label>
                                            <input type="file" name="profile_photo" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="border-left border-3 border-primary" style="height: 100px;"></div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Buyer Information
                                </h4>
                            </div>
                            <div class="card-body">

                                <div class="row-md-6">
                                    <table class="table table-bordered" id="dataTable1">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Buyer Company Name</th>
                                                <th>Contact No.</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>1</td>
                                            <td>
                                                <div class="form-group">

                                                    <select class="form-control">
                                                        <option>--Select Buyer--</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="poa" class="form-control" required
                                                            placeholder="Contact NO.">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="email" class="form-control" required
                                                            placeholder="Email">
                                                    </div>
                                                </div>
                                            </td>
                                        </tbody>
                                    </table>



                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Seller Information
                                </h4>
                            </div>
                            <div class="card-body">

                                <div class="row-md-6">
                                    <table class="table table-bordered" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Seller Company Name</th>
                                                <th>Contact No.</th>
                                                <th>Email</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>1</td>
                                            <td>
                                                <div class="form-group">

                                                    <select class="form-control">
                                                        <option>--Select Seller--</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="poa" class="form-control" required
                                                            placeholder="Contact NO.">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="email" class="form-control" required
                                                            placeholder="Email">
                                                    </div>
                                                </div>
                                            </td>
                                        </tbody>
                                    </table>



                                </div>

                            </div>
                        </div>
                        <div class="card">

                            <div class="card-body">

                                <div class="row-md-6">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" name="save"
                                                class="btn btn-primary btn-block float-right">Save</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include ("footer.php");
?>