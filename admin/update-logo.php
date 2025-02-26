<?php
include ('sidebar.php');
$id = $_GET['id'];
$sql = "SELECT * FROM `logo` WHERE `id` = '$id'";
$rs = $connection->query($sql);
$row = mysqli_fetch_assoc($rs);
// var_dump($row);
?>
<div class="col-10">
    <div class="content-right">
        <div class="top">
            <h3>Update Logo</h3>
        </div>
        <div class="bottom">
            <figure>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Status:</label>
                        <select name="status" class="form-select">
                            <option value="Header" <?php if ($row['status'] == "Header")
                                echo "selected" ?>>Header</option>
                                <option value="Footer" <?php if ($row['status'] == "Footer")
                                echo "selected" ?>>Footer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="thumbnail" class="form-control">
                            <input type="text" name="old_thumbnail" value="<?php echo $row['thumbnail'] ?>" id="">
                        <img src="assets/image/<?php echo $row['thumbnail'] ?>" alt="" width="150px">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="btn-update-logo" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </figure>
        </div>
    </div>
</div>
</div>
</div>
</main>
</body>

</html>