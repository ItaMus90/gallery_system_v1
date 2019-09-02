<?php include "includes/header.php"?>

<?php

    require_once "admin/includes/init.php";

    $msg = null;
    $author = null;
    $body = null;

    if (empty($_GET["id"]) || !isset($_GET["id"])){

        redirect("index.php");

    }


    $photo = Photo::get_by_id($_GET["id"]);


    if (isset($_POST["submit"])){

        $author = trim($_POST["author"]);
        $body = trim($_POST["body"]);

        $comment = Comment::create_comment($photo->id, $author, $body);

        if (key($comment) && $comment->save()){

            redirect("photo.php?id=" . $photo->id);

        } else {

            $msg = "Error save comment";

        }

    }

    $comments = Comment::find_comments($photo->id);


?>


    <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Author</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->get_images_path(); ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p>
                    <?php echo $photo->description; ?>
                </p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">

                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                            
                        </div>
                        <div class="form-group">
                            
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->

                <?php foreach ($comments as $comm): ?>

                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="https://via.placeholder.com/64&text=<?php echo $comm->author;?>" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <?php echo $comm->author;?>
                                <small><?php echo $comm->date;?></small>
                            </h4>
                            <?php echo $comm->body;?>
                        </div>
                    </div>

                <?php endforeach; ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
<!--            <div class="col-md-4">-->


<?php //include("includes/sidebar.php"); ?>



<!--</div> col-md-4-->
<!-- /.row -->
    </div>
<?php include("includes/footer.php"); ?>
