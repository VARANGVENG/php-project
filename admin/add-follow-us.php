<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Follow Us</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label>Thumbnail<span class="text-danger">Recommend size ( width = 40px )</span></label>
                                        <input type="file" name="thumbnail" class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label>Label</label>
                                        <input type="text" name="label" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" name="url" class="form-control"></input>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-add-followUs" class="btn btn-primary">Submit</button>
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