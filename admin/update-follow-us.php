<?php 
    include('sidebar.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM `follow_us` WHERE `id` = '$id'";
    $rs  = $connection->query($sql);
    $row = mysqli_fetch_assoc($rs);
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Follow Us</h3>
                        </div> 
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label>Thumbnail <span class="text-danger">Recommend size ( width = 40px )</span> </label>
                                        <input name="thumbnail" type="file" class="form-control">
                                        <input type="text" name="old_thumbnail"  value="<?php echo $row['thumbnail'] ?>" id="">
                                        <img src="assets/image/<?php echo $row['thumbnail'] ?>" alt="" width="40px">
                                    </div>
                                    <div class="form-group">
                                        <label>Label</label>
                                        <input type="text" value="<?php echo $row['label'] ?>" name="label" class="form-control" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" value="<?php echo $row['url'] ?>" name="url" class="form-control" alt="">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-update-followUs" class="btn btn-primary">Update</button>
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