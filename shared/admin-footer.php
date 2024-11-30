<?php 
unset($_SESSION['error']);
unset($_SESSION['success']);
unset($_SESSION['categoryname']);
unset($_SESSION['errorEdit']);
unset($_SESSION['successEdit']);
unset($_SESSION['categorynameEdit']);
unset($_SESSION['categoryIdEdit']);
unset($_SESSION['successDelete']);


unset($_SESSION['authorfirstname']);
unset($_SESSION['authorlastname']);
unset($_SESSION['authoremail']);
unset($_SESSION['authorbio']);
?>
</div>
<!-- load JS files -->
<script src="<?php echo BASE_URL;?>/assets/js/author.js?v=<?php echo time();?>"></script>
<script src="<?php echo BASE_URL;?>/assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo BASE_URL;?>/assets/js/popper.min.js"></script>
<script src="<?php echo BASE_URL;?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL;?>/assets/js/custom.js?v=<?php echo time();?>"></script>
<script src="<?php echo BASE_URL;?>/assets/js/category.js?v=<?php echo time();?>"></script>

</body>
</html>