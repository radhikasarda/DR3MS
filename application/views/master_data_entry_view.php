<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/toast.css'?>" type="text/css">
		<style>
			
			.logoutbutton 
			{
				background-color: #FF0000;
				border: none;
				color: white;
				padding: 0px 20px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 12px;
				margin: 4px 2px;
				cursor: pointer;
			}
			
		</style>
		<title>DR3MS::Master data Entry</title>
		
	</head>
	
	<body style="overflow-x:hidden;overflow-y:auto;">
	
		<script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/toast.js'?>"></script>		
		
		<div class= "header-container" >
			<div class = "header">
				<?php $this->load->view('header_view');?>
			</div>
		</div>
		<div class = "row" style="margin-right:0px;">
			<div class = "col-sm-6" style = "text-align: left; background-color: #FFB700;height: 25px;">
				<i class="glyphicon glyphicon-user"></i>
				<font color="#000000" size="4">
				"You are logged in as : <?php echo $this->session->userdata('userid'); ;?>" 
				&ensp;
				<i class="glyphicon glyphicon-bell" aria-hidden="true"></i>
				Last Login Time : 	
				<?php foreach((array)$last_login as $last_login){	 
					 echo $last_login->last_login_time;
				}?>
				</font>	
			
	
			</div>
			<div class = "col-sm-6" style = "text-align: right;  height: 25px;background-color: #FFB700;">
				<form action="<?php echo base_url("login/logout");?>">
					<input type="submit" class="logoutbutton" value="LOGOUT">
				</form>
			</div>
		</div>
		<div>
		<?php $this->load->view('navbar_view');?>
		</div>	
		<nav class="navbar navbar-inverse" id="selection-bar" style="background-color: #FFB700;margin-top:-20px;">
			<div class="container">
				<div class="row">
					<div class="col-sm-12" style="padding-top:8px;">	
						<div class="col-sm-2">
						</div>
						<div class="col-sm-8">
							<div class="col-sm-3">
								<div style="margin-top:5px;">
								<label>Select Item:</label>
								</div>
							</div>
							<div class="col-sm-3" style="padding-left:0px;">						
								<select class="form-control" name = "resources" id="resources" >
									<option value="select">--Select--</option>
									<option value="circle">Circle</option>
									<option value="block">Block</option>
									<option value="gp">GP</option>
									<?php
									foreach($resources as $row)
									{
									 echo '<option value="'.$row->resource.'">'.$row->resource.'</option>';
									}
									?>						
								</select>						
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-primary" onclick="return GetSelectedData();" >SUBMIT</button>		
							</div>
							<script>
								function GetSelectedData()
								{
									if($('#resources').val() == "select")
									{
										iqwerty.toast.Toast('Please SELECT a RESOURCE !!');
										return;	
									}
									if($('#resources').val() == "circle" || $('#resources').val() == "block" || $('#resources').val() == "gp" )
									{
										getDetailedData();
									}
									else{
										$.ajax({
														url:"<?php echo site_url('Master_data/onClickSubmit');?>",
														method:"POST",
														data:{resource_id:$('#resources').val()},
														type: "POST",
														cache: false,
														success: function(data){
															$('#detailed-info').hide(); 	
															$('#master-data-entry-div').show();
															$('#master-data-entry-div').html(data); 
														}

										});
									}
								}
							</script>					
						</div>
						<div class="col-sm-2">
						</div>
					</div>
				</div>
			</div>
		</nav>
		<div id ="master-data-entry-div" style="display:none;">
		</div>
		<div id ="detailed-info" style="display:none;">			
			<div class="container" style="overflow-x:auto;overflow-y:auto;height:550px;">				
					<table id ="item-detail-table" class="table table-striped table-bordered" >				
					</table>	
						
			</div>
			<div class ="col-md-5"></div>
			<div class ="col-md-4">
			<button type="button" class="btn btn-primary" onclick="return onClickAddMoreData();">ADD MORE DATA</button>
			</div>			
		</div>
		<script>
		function getDetailedData()
		{
			var selected_item = $('#resources').val();
			$.ajax({
													url:"<?php echo site_url('Master_data/getItemDetails');?>",
													method:"POST",
													data:{resource_id:selected_item},
													type: "POST",
													cache: false,
													success: function(data){
														$('#master-data-entry-div').hide();
														$('#item-detail-table').html(data);
														$('#detailed-info').show(); 			
													}

										});
		}
		function onClickAddMoreData()
		{
			$selected_item = $('#resources').val();
			$.ajax({
														url:"<?php echo site_url('Master_data/onClickAddMoreData');?>",
														method:"POST",
														data:{resource_id:$('#resources').val()},
														type: "POST",
														cache: false,
														success: function(data){
															$('#detailed-info').hide(); 	
															$('#master-data-entry-div').show();
															$('#master-data-entry-div').html(data); 
														}

			});
		}
		function onClickAddCircleData()
		{
			var name_of_circle = document.getElementById("name_of_circle").value; 
			
			if(name_of_circle == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddCircleData');?>",
							method:"POST",
							data:{name_of_circle:name_of_circle},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									getDetailedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

			});	
			}
		}
		function onClickAddBlockData()
		{
			var selected_circle = $('#circles').val();
			var name_of_block = document.getElementById("name_of_block").value; 
			
			if(name_of_block == '' || selected_circle == 'select' )
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
								url:"<?php echo site_url('Master_data/onClickAddBlockData');?>",
								method:"POST",
								data:{selected_circle:selected_circle,name_of_block:name_of_block},
								type: "POST",
								cache: false,
								success: function(data)
								{
									if(data == 1)
									{
										iqwerty.toast.Toast('Data Inserted Successfully !!');
										$('#master-data-entry-div').hide();
										getDetailedData();
									}
									else									
									{
										iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
									}
								}

				});	
			}			
		}
		function onClickAddGpData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var name_of_gp = document.getElementById("name_of_gp").value;
			
			if(selected_circle == 'select' || selected_block == 'select' || name_of_gp == '' )
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;		
			}
			$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddGpData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,name_of_gp:name_of_gp},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									getDetailedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

			});
		}
		function onClickAddAssetsData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();			
			var name_of_item = document.getElementById("name_of_item").value; 								
			var no_of_item = $("#no_of_item").val();
			var name_of_owner = document.getElementById("name_of_owner").value; 
			var address = document.getElementById("address").value; 
			var contact_no = document.getElementById("contact_no").value; 
			var capacity = $("#capacity").val();

			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || name_of_item == '' || no_of_item == '' || name_of_owner == '' || address == '' || contact_no == '' || capacity == '' )
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddAssetsData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name_of_item:name_of_item,no_of_item:no_of_item,name_of_owner:name_of_owner,address:address,contact_no:contact_no,capacity:capacity},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
				
		}
		
		function onClickAddCommunityHallData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();			
			var community_hall = document.getElementById("community_hall").value; 								
			var capacity_1 = $("#capacity_1").val();
			var address = document.getElementById("address").value; 
			var contact_no = document.getElementById("contact_no").value; 
			var capacity_2 = $("#capacity_2").val();
			var gps_point = document.getElementById("gps_point").value; 
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || community_hall == '' || capacity_1 == '' || address == '' || contact_no == '' || capacity_2 == '' || gps_point == '' )
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddCommunityHallData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,community_hall:community_hall,capacity_1:capacity_1,address:address,contact_no:contact_no,capacity_2:capacity_2,gps_point:gps_point},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
				
		}
		
		function onClickAddDemographicData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();										
			var total_population = $("#total_population").val();
			var male_child = $("#male_child").val();
			var female_child = $("#female_child").val();
			var male_adult = $("#male_adult").val();
			var female_adult = $("#female_adult").val();
			var male_old = $("#male_old").val();
			var female_old = $("#female_old").val();
			var no_of_bpl_families = $("#no_of_bpl_families").val();
			var families_with_pucca_house = $("#families_with_pucca_house").val();
			var families_with_kutcha_house = $("#families_with_kutcha_house").val();
			var landless_families = $("#landless_families").val();
			var homeless_families = $("#homeless_families").val();
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || total_population == '' || male_child == '' || female_child == '' || male_adult == '' || female_adult == '' || male_old == '' || female_old == '' || no_of_bpl_families == '' || families_with_pucca_house == '' || families_with_kutcha_house == '' || landless_families == '' || homeless_families == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddDemographicData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,total_population:total_population,male_child:male_child,female_child:female_child,male_adult:male_adult,female_adult:female_adult,male_old:male_old,female_old:female_old,no_of_bpl_families:no_of_bpl_families,families_with_pucca_house:families_with_pucca_house,families_with_kutcha_house:families_with_kutcha_house,landless_families:landless_families,homeless_families:homeless_families},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
		}
		
		function onClickAddEmbankmentData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();			
			var name_of_embankment = document.getElementById("name_of_embankment").value; 								
			var status = $("#status").val();
			var village_coverage = $("#village_coverage").val();
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || name_of_embankment == '' || status == 'select' || village_coverage == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddEmbankmentData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name_of_embankment:name_of_embankment,status:status,village_coverage:village_coverage},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
		}
		
		function onClickAddHandPumpRingWellData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();			
			var village = document.getElementById("village").value; 								
			var location = document.getElementById("location").value; 
			var gps_point = document.getElementById("gps_point").value; 
			var provider = document.getElementById("provider").value; 
			var name_of_provider = document.getElementById("name_of_provider").value; 
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || village == '' || location == '' || gps_point == '' || provider == '' || name_of_provider == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddHandPumpRingWellData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,village:village,location:location,gps_point:gps_point,provider:provider,name_of_provider:name_of_provider},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
		}
		
		function onClickAddHealthCentreData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();		
			var name_of_health_centre = document.getElementById("name_of_health_centre").value;			
			var address = document.getElementById("address").value; 
			var contact_no = document.getElementById("contact_no").value; 
			var no_of_doctors = $("#no_of_doctors").val();
			var no_of_anm = $("#no_of_anm").val();
			var building_type = document.getElementById("building_type").value; 
			var no_of_beds = $("#no_of_beds").val();
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || name_of_health_centre == '' || address == '' || contact_no == '' || no_of_doctors == '' || no_of_anm == '' || building_type == '' || no_of_beds == '' )
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddHealthCentreData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name_of_health_centre:name_of_health_centre,address:address,contact_no:contact_no,no_of_doctors:no_of_doctors,no_of_anm:no_of_anm,building_type:building_type,no_of_beds:no_of_beds},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
		}
		
		function onClickAddInaccessibleData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();		
			var inaccessible_area = document.getElementById("inaccessible_area").value;			

			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || inaccessible_area == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddInaccessibleData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,inaccessible_area:inaccessible_area},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
		}
		
		function onClickAddInstitutionData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();										
			var total_lp_school = $("#total_lp_school").val();
			var total_me_school = $("#total_me_school").val();
			var total_high_school = $("#total_high_school").val();
			var total_hs_school = $("#total_hs_school").val();
			var total_college = $("#total_college").val();
			var other_institutions = $("#other_institutions").val();
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || total_lp_school == '' || total_me_school == '' || total_high_school == '' || total_hs_school == '' || total_college == '' || other_institutions == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddInstitutionData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,total_lp_school:total_lp_school,total_me_school:total_me_school,total_high_school:total_high_school,total_hs_school:total_hs_school,total_college:total_college,other_institutions:other_institutions},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
		}
		
		function onClickAddRaisedPlatformData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();										
			var raised_platform = document.getElementById("raised_platform").value;			
			var address = document.getElementById("address").value; 
			var contact_no = document.getElementById("contact_no").value; 
			var capacity = $("#capacity").val();
			var gps_point = document.getElementById("gps_point").value; 
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || raised_platform == '' || address == '' || contact_no == '' || capacity == '' || gps_point == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			else
			{
				$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddRaisedPlatformData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,raised_platform:raised_platform,address:address,contact_no:contact_no,capacity:capacity,gps_point:gps_point},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			}
		}
		
		function onClickAddRelifCampData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();										
			var name_of_school = document.getElementById("name_of_school").value;			
			var address = document.getElementById("address").value; 
			var contact_no = document.getElementById("contact_no").value; 
			var no_of_classroom = $("#no_of_classroom").val();
			var type_of_building = document.getElementById("type_of_building").value; 
			var no_of_toilets = $("#no_of_toilets").val();
			var source_of_drinking_water = $('#source_of_drinking_water').val();
			var open_space_yes = document.getElementById("open_space_yes");
			var open_space_no = document.getElementById("open_space_no"); 
			var electricity_available_yes = document.getElementById("electricity_available_yes"); 
			var electricity_available_no = document.getElementById("electricity_available_no"); 
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || name_of_school == '' || address == '' || contact_no == '' || no_of_classroom == '' || type_of_building == '' || no_of_toilets == '' || source_of_drinking_water == 'select')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			if(open_space_yes.checked == false && open_space_no.checked == false)
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			
			if(electricity_available_yes.checked == false && electricity_available_no.checked == false)
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}
			var open_space = "no";
			var electricity_available = "no";
			
			if(open_space_yes.checked)
			{
				open_space = open_space_yes.value;
			}
			if(electricity_available_yes.checked)
			{
				electricity_available = electricity_available_yes.value;
			}
			

			$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddRelifCampData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name_of_school:name_of_school,address:address,contact_no:contact_no,no_of_classroom:no_of_classroom,type_of_building:type_of_building,no_of_toilets:no_of_toilets,source_of_drinking_water:source_of_drinking_water,open_space:open_space,electricity_available:electricity_available},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
			
		}
		
		function onClickAddTaskForceData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();										
			var total_rev_village = $('#total_rev_village').val();	
			var total_govt_land = document.getElementById("total_govt_land").value; 
			var total_forest_land = document.getElementById("total_forest_land").value; 
			var designation = document.getElementById("designation").value; 
			var name_of_members = document.getElementById("name_of_members").value; 
			var contact_no = document.getElementById("contact_no").value;  
			var address = document.getElementById("address").value; 
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || total_rev_village == '' || total_govt_land == '' || total_forest_land == '' || designation == '' || name_of_members == '' || contact_no == '' || address == 'select')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}

			$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddTaskForceData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,total_rev_village:total_rev_village,total_govt_land:total_govt_land,total_forest_land:total_forest_land,designation:designation,name_of_members:name_of_members,contact_no:contact_no,address:address},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
		}
		
		function onClickAddTelecommunicationData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();										
			var name_of_village = document.getElementById("name_of_village").value; 
			var location = document.getElementById("location").value; 
			var name_of_service_provider = document.getElementById("name_of_service_provider").value; 
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || name_of_village == '' || location == '' || name_of_service_provider == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}

			$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddTelecommunicationData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name_of_village:name_of_village,location:location,name_of_service_provider:name_of_service_provider},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
		}
		
		function onClickAddVulRoadCulvertBridgeData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();										
			var name_of_vul_road = document.getElementById("name_of_vul_road").value; 
			var name_of_vul_culvert = document.getElementById("name_of_vul_culvert").value; 
			var name_of_vul_bridge = document.getElementById("name_of_vul_bridge").value; 
			var status = document.getElementById("status").value; 
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || name_of_vul_road == '' || name_of_vul_culvert == '' || name_of_vul_bridge == '' || status == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}

			$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddVulRoadCulvertBridgeData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name_of_vul_road:name_of_vul_road,name_of_vul_culvert:name_of_vul_culvert,name_of_vul_bridge:name_of_vul_bridge,status:status},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
		}
		
		function onClickAddVulVillageData()
		{
			var selected_circle = $('#circles').val();
			var selected_block = $('#blocks').val();
			var selected_gp = $('#gp').val();										
			var name_of_village = document.getElementById("name_of_village").value; 
			var nature_of_disaster = document.getElementById("nature_of_disaster").value; 
			
			if(selected_circle == 'select' || selected_block == 'select' || selected_gp == 'select' || name_of_village == '' || nature_of_disaster == '')
			{
				iqwerty.toast.Toast('Some Fields are Missing !!');
				return;	
			}

			$.ajax({
							url:"<?php echo site_url('Master_data/onClickAddVulVillageData');?>",
							method:"POST",
							data:{selected_circle:selected_circle,selected_block:selected_block,selected_gp:selected_gp,name_of_village:name_of_village,nature_of_disaster:nature_of_disaster},
							type: "POST",
							cache: false,
							success: function(data)
							{
								if(data == 1)
								{
									iqwerty.toast.Toast('Data Inserted Successfully !!');
									$('#master-data-entry-div').hide();
									GetSelectedData();
								}
								else									
								{
									iqwerty.toast.Toast('Data NOT Inserted !! Please TRY AGAIN');	
								}
							}

							});
		}
		</script>
	</body>
</html>