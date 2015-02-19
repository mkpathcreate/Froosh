</div>
                </div>            
</div>

<hr>
            <footer>
                <center><p></p></center>
            </footer>
        </div>
        <!--/.fluid-container-->
        
        <script src="<?php echo $this->config->item('base_url'); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->config->item('base_url'); ?>assets/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo $this->config->item('base_url'); ?>assets/js/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>