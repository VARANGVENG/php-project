<?php
include ('sidebar.php');
$id = $_GET['id'];
$sql = "SELECT * FROM `about_us` WHERE `id` = '$id'";
$rs = $connection->query($sql);
$row = mysqli_fetch_assoc($rs);
// var_dump($row);
?>
<div class="col-10">
    <div class="content-right">
        <div class="top">
            <h3>Update About Us</h3>
        </div>
        <div class="bottom">
            <figure>
                <form method="post">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Description</label> 
                            <input type="text" name="description" value="<?php echo $row['description'] ?>" class="form-control" ></input>
                        </div>
                    <div class="form-group">
                        <button type="submit" name="btn-update-aboutUs" class="btn btn-primary">Update</button>
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