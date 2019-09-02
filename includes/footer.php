
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center">Copyright &copy; GSystem <span id="fullyear"></span> </p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>

        function getFullYear(){

            var year = document.getElementById("fullyear");
            year.innerText = new Date().getFullYear();

        }

        getFullYear();

    </script>

</body>

</html>
