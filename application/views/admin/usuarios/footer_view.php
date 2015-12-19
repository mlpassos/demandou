<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>/assets/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <?php 
    foreach($js as $j) {
      // echo $c['file'];
      echo  "<script src='" . $j['file'] . "'></script>\n";
    }
    ?>
</body>
</html>
