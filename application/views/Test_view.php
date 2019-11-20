<html>
	<head>
	<title>DR3MS::Disaster Risk Reduction and Resource Management System </title>
	</head>
	<body>
	
	<form  id = "test" action="<?php echo base_url("Test/clickTest");?>"  method="POST" >
	<button type="button" onClick = "return hello()"> <font color="blue">CLICK</font></button>
	</form>
	<script>
	function hello(){
		document.getElementById('test').submit();
	}
	</script>
	</body>
</html>