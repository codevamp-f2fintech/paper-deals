<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 style="font-size:25px;color:#1C2434;margin:40px 0 20px 3px">
                            Add Category
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Category Name" required>
                                        </div>
                                    </div>
                                    <style>
                                        #lmm>input {
                                            border-radius: 4px;
                                        }

                                        #lmm>input::file-selector-button {
                                            /* font-weight: bold; */
                                            height: 35px;
                                            color: #666666;
                                            /* padding: 0.5em; */
                                            border: thin solid grey;
                                            border-radius: 3px;
                                        }
                                    </style>
                                    <div class="col-md-6">
                                        <div class="form-group" id="lmm">

                                            <label>Upload Image</label><br />
                                            <input type="file" name="image" class="border" style="width:100%" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-white">Save</label>
                                            <button type="submit" name="add_category"
                                                class="btn btn-primary btn-block float-right">Add Category</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
</div>
</section>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js"
    integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
    </script>
<?php
include ("footer.php");
?>