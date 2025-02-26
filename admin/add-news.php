<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select name="news_type" class="form-select">
                                            <option value="Social">Social</option>
                                            <option value="Sport">Sport</option>
                                            <option value="Entertainment">Entertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-select">
                                            <option value="National">National</option>
                                            <option value="International">International</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Thumbnail <span class="text-danger">Recommend size (350px x 200px)</span> </label>
                                        <input name="thumbnail" type="file" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Banner <span class="text-danger">Recommend size (730px x 415px)</span> </label>
                                        <input name="banner" type="file" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-add-news" class="btn btn-primary">Submit</button>
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