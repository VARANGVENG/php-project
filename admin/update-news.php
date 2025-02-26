<?php 
    include('sidebar.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM `news` WHERE `id` = '$id'";
    $rs  = $connection->query($sql);
    $row = mysqli_fetch_assoc($rs);
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update News</h3>
                        </div> 
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" value="<?php echo $row['title'] ?>" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select name="news_type" class="form-select">
                                            <option value="Social" <?php if($row['news_type']=="Social") echo 'Selected'  ?>>Social</option>
                                            <option value="Sport" <?php if($row['news_type']=="Sport") echo 'Selected' ?>>Sport</option>
                                            <option value="Entertainment" <?php if($row['news_type']=="Entertainment") echo 'Selected' ?>>Entertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-select">
                                            <option value="National" <?php if($row['category']=="National") echo 'Selected' ?>>National</option>
                                            <option value="International" <?php if($row['category']=="International") echo 'Selected' ?>>International</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Thumbnail <span class="text-danger">Recommend size (350px x 200px)</span> </label>
                                        <input name="thumbnail" type="file" class="form-control">
                                        <input type="text" name="old_thumbnail"  value="<?php echo $row['thumbnail'] ?>" id="">
                                        <img src="assets/image/<?php echo $row['thumbnail'] ?>" alt="" width="150px">
                                    </div>
                                    <div class="form-group">
                                        <label>Banner <span class="text-danger">Recommend size (730px x 415px)</span> </label>
                                        <input name="banner" type="file" class="form-control">
                                        <input type="text" name="old_banner"  value="<?php echo $row['banner'] ?>" id="">
                                        <img src="assets/image/<?php echo $row['banner'] ?>" alt="" width="150px">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"><?php echo $row['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-update-news" class="btn btn-primary">Update</button>
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