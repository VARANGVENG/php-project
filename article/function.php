<!-- @import jquery & sweet alert  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php
$connection = new mysqli('localhost', 'root', '', 'php_project_management');

function getLogo($status)
{
    global $connection;
    $sql = "SELECT * FROM `logo` WHERE `status`='$status'  ORDER BY `id` DESC LIMIT 1";
    $rs = $connection->query($sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        if ($row['status'] == 'Header') {
            echo '<img src="../admin/assets/image/' . $row['thumbnail'] . '" width="100px" height="100px" alt="">';
        }
        if ($row['status'] == 'Footer') {
            echo '<img src="../admin/assets/image/' . $row['thumbnail'] . '" width="150px" height="120px" alt="">';
        }
    }
}

function getNews($news_type)
{
    global $connection;
    $sql = "SELECT * FROM `news` WHERE `news_type`='$news_type' ORDER BY `id` DESC LIMIT 3";
    $rs = $connection->query($sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo '
         <div class="col-4">
        <figure>
            <a href="news-detail.php?id=' . $row['id'] . '">
                <div class="thumbnail">
                <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="350px" height="200px" alt="">
                <div class="title">
                    ' . $row['title'] . '
                </div>
                </div>   
            </a>
        </figure>
    </div>
       ';
    }
}

function getNewsDetail()
{
    global $connection;
    $id = $_GET['id'];
    $sql = "SELECT * FROM `news` WHERE `id`='$id'";
    $rs = $connection->query($sql);
    $row = mysqli_fetch_assoc($rs);
    echo '
      <div class="col-8">
         <div class="main-news">
           <div class="thumbnail">
              <img src="../admin/assets/image/' . $row['banner'] . '" width="750" height="415" alt="">
               </div>
                  <div class="detail"> 
                   <h3 class="title">' . $row['title'] . '</h3>
                    <div class="date">' . $row['postdate'] . '</div>
                    <div class="description">
                    ' . $row['description'] . '
              </div>
           </div>
         </div> 
    </div>
    ';

    $old_viewer = $row['viewer'];
    $news_viewer = $old_viewer + 1;
    $sqlviewer = "UPDATE `news` SET `viewer`='$news_viewer' WHERE `id`='$id'";
    $rsviewer = $connection->query($sqlviewer);
}

function trending()
{
    global $connection;
    $sql = "SELECT * FROM `news` ORDER BY `viewer` DESC LIMIT 1";
    $rs = $connection->query($sql);
    $row = mysqli_fetch_assoc($rs);
    echo '
      <div class="col-8 content-left">
            <figure>
                <a href="news-detail.php?id=' . $row['id'] . '">
                <div class="thumbnail">
                <img src="../admin/assets/image/' . $row['banner'] . '" width="730" height="415"" alt="">
                <div class="title">
                    ' . $row['title'] . '
                </div>
                </div>
                </a>
            </figure>
     </div>
    ';
}

function min_trending()
{
    global $connection;
    $sqlID = "SELECT `id` FROM `news` ORDER BY `viewer` DESC LIMIT 1";
    $rsID = $connection->query($sqlID);
    $rowID = mysqli_fetch_assoc($rsID);
    $id = $rowID['id'];

    $sql = "SELECT * FROM `news` WHERE `id` !='$id' ORDER BY `viewer` DESC LIMIT 2";
    $rs = $connection->query($sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo '
        <div class="col-8">
            <figure>
                <a href="news-detail.php?id=' . $row['id'] . '">
                <div class="thumbnail">
                <img src="../admin/assets/image/' . $row['banner'] . '" width="350" height="200"" alt="">
                <div class="title">
                    ' . $row['title'] . '
                </div>
                </div>
                </a>
            </figure>
       </div>
        ';
    }

}

function relateNews()
{
    global $connection;

    $id = $_GET['id'];

    $sqlNewsType = "SELECT `news_type` FROM `news` WHERE `id`= '$id' ";
    $rsNewsType = $connection->query($sqlNewsType);
    $rowNeswType = mysqli_fetch_assoc($rsNewsType);
    $newsType = $rowNeswType['news_type'];

    $sql = "SELECT * FROM `news` WHERE `id` != '$id' ORDER BY `id` AND `news_type`='$newsType' DESC LIMIT 2";
    $rs = $connection->query($sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo '
        <figure>  
            <a href="news-detail.php?id=' . $row['id'] . '">
            <div class="thumbnail">
                <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="350" height="200"  alt="">
                </div>
                    <div class="detail">
                    <h3 class="title">' . $row['title'] . '</h3>
                    <div class="date">' . $row['postdate'] . '</div>
                    <div class="description">
                    ' . $row['description'] . '
                </div>
            </div>
           </a>
        </figure>
        ';
    }
}

function trending_link()
{
    global $connection;
    $sql = "SELECT `id`,`title` FROM `news` ORDER BY `viewer` DESC LIMIT 3";
    $rs = $connection->query($sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo '     
         <i class="fas fa-angle-double-right"></i> 
         <a href="news-detail.php?id=' . $row['id'] . '">' . $row['title'] . '</a> &ensp;                        
         ';
    }

}

function getNewsByNewsType($newsType,$category)
{    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }
    //   $page = $_GET['page']; 
    $show_news = ($page-1)*3; 

    global $connection;
    $sql = "SELECT * FROM `news` WHERE `news_type`='$newsType' AND `category`='$category' ORDER BY `id` DESC LIMIT $show_news,3";
    $rs = $connection->query($sql); 
    while ($row = mysqli_fetch_assoc($rs)) {
        echo '
        <div class="col-4">
            <figure>
                <a href="news-detail.php?id=' . $row['id'] . '">
                <div class="thumbnail">
                <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="350" height="200"  alt="">
                </div>
                    <div class="detail">
                    <h3 class="title">' . $row['title'] . '</h3>
                    <div class="date">' . $row['postdate'] . '</div>
                    <div class="description">
                    ' . $row['description'] . '
                </div>
                </div>
                </a>
            </figure>
        </div>
        ';
    }
}

function pagination($newsType,$category){

    global $connection;
    $sql = "SELECT COUNT(`id`) AS 'Total_news' FROM `news` WHERE `news_type`='$newsType' AND `category`='$category'";
    $rs = $connection->query($sql);
    $row = mysqli_fetch_assoc($rs);
    $total_news = $row['Total_news'];
    $total_page = ceil($total_news / 3);
    // echo $row['Total_news'];
    for($i=1;$i<=$total_page;$i++){
        echo'
            <li>
                <a href="?page='.$i.'">'.$i.'</a>
            </li>
        ';
    }    
}
 
function search(){
    global $connection;
    $search = $_GET['query'];
    $sql = "SELECT * FROM `news` WHERE `title` LIKE '%$search%'";
    $rs = $connection->query($sql);
    while($row=mysqli_fetch_assoc($rs)){
        echo'
           <figure>
                <a href="news-detail.php?id=' . $row['id'] . '">
                <div class="thumbnail">
                <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="350" height="200"  alt="">
                </div>
                    <div class="detail">
                    <h3 class="title">' . $row['title'] . '</h3>
                    <div class="date">' . $row['postdate'] . '</div>
                    <div class="description">
                    ' . $row['description'] . '
                </div>
                </div>
                </a>
            </figure>
        ';
    }
}

function viewAboutUs(){
 global $connection;
 $sql = "SELECT * FROM `about_us` ORDER BY `id` DESC LIMIT 1";
 $rs = $connection->query($sql);
 while($row=mysqli_fetch_assoc($rs)){
    echo'   
        <tr>
           <td>'. $row['description'] .'</td>
        </tr>
    ';
 }
}

function addFeedback(){
    global $connection;
    if(isset($_POST['btn_message'])){
    $username = $_POST['txtUsername'];
    $email = $_POST['txtEmail'];
    $telephone = $_POST['txtTelephone'];
    $address = $_POST['txtAddress'];
    $message = $_POST['txtMessage'];
    if(!empty($username) && !empty($email) && !empty($telephone) && !empty($address) && !empty($message)){
         $sql = "INSERT INTO `feedback`(`username`,`email`,`telephone`,`address`,`message`) VALUES ('$username','$email','$telephone','$address','$message')";
         $rs = $connection->query($sql);
         if ($rs) {
             echo '
                <script>
                    $(document).ready(function(){ 
                        swal({
                        title: "Success",
                        text: "Feedback add Successfully!",
                        icon: "success",
                     });
                   });
                </script>
             ';
           }
       }
       else{
        echo'
          <script>
            $(document).ready(function(){ 
                swal({
                title: "Error",
                text: "Feedback add Unsuccessfully!",
                icon: "error",
               });
            });
        </script>
        ';
       }
    }
  }
  addFeedback();

  function viewFollowUs()
  {
    global $connection;
    $sql = "SELECT * FROM `follow_us` ORDER BY `id`";
    $rs = $connection->query($sql);
    while ($row = mysqli_fetch_assoc($rs)) {
      echo '
          <tr>
            <li>
             <img src="../admin/assets/image/' . $row['thumbnail'] . '" width="40px"> <a href="' .$row['url']. '">'.$row['label'].'</a>
            </li>
          </tr>
      ';
    }
  }

