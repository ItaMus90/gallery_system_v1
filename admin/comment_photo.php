<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>

<?php

    if (!isset($_GET["id"]) || !empty($_GET["id"])){

        redirect("photos.php");

    }

?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->

        <?php include "includes/top_nav.php"; ?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

        <?php include "includes/side_nav.php"; ?>

        <!-- /.navbar-collapse -->

    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        COMMENTS
                    </h1>

                    <div class="col-md-12">

                        <table class="table table-hover">

                            <thead>

                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Body</th>
                                <th>Date</th>
                            </tr>

                            </thead>
                            <tbody>
                            <?php foreach ($comments as $comment) : ?>
                                <tr>
                                    <td>
                                        <?php echo $comment->id; ?>
                                    </td>
                                    <td>
                                        <?php echo $comment->author; ?>
                                        <div class="action_links">

                                            <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>

                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $comment->body; ?>
                                    </td>
                                    <td>
                                        <?php echo $comment->date; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>

                        </table>

                    </div><!--col-md-12-->

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>