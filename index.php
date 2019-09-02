<?php include("includes/header.php"); ?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                <div class="thumbnail row">

                    <?php foreach ($photos as $photo): ?>

                            <div class="col-xs-6 col-md-3">

                                <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">

                                    <img src="admin/<?php echo $photo->get_images_path() ?>" class="photo-thumbnail" alt="">

                                </a>
                            </div>




                    <?php endforeach; ?>

                </div><!--thumbnail row -->

            </div>




            <!-- Blog Sidebar Widgets Column -->
<!--            <div class="col-md-4">-->

            
                 <?php //include("includes/sidebar.php"); ?>



<!--        </div>-->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
