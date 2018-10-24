<?php

    include_once("connect/db_cls_connect.php");
    include_once("main.class.php");

    $db = new dbObj();
    $connString =  $db->getConnstring();
    $mainCls = new Main($connString);
    $country_data_arr = $mainCls->getCountryList();
    $subjects_data_arr = $mainCls->getSubjectList();

    function reportingMangerTree($mainCls,$parent_id = 'NULL', $sub_mark = ''){
    	
    	$query = $mainCls->getAllReportingManager($parent_id);
    	$list ='';
    	if(isset($query) && !empty($query)){
        	foreach ($query as $querykey => $queryvalue) {
           		 $list.= '<option value="'.$queryvalue['id'].'">'.$sub_mark.$queryvalue['emp_name'].'</option>';
            	$list.= reportingMangerTree($mainCls,$queryvalue['id'], $sub_mark.'---');
        	}
        	  return $list;

    	}
    	
   } 

    $reportingMangerTreedata = reportingMangerTree($mainCls,'NULL','','');
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Add Employee</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
      <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
               <div class="page-header"></div>
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Add Employee Infomation</h3>
                  </div>
                  <p id="msg" style="text-align: center; color: red;"></p>
                  <div class="panel-body">
                     <form id="frmemployee" name="frmemployee" method="post" class="form-horizontal" action="" enctype=multipart/form-data>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_name">Name</label>
                           <div class="col-sm-5">
                              <input type="text" class="form-control" id="emp_name" name="emp_name" placeholder="Name" />
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_email">Email Address</label>
                           <div class="col-sm-5">
                              <input type="text" class="form-control" id="emp_email" name="emp_email" placeholder="Email Address" />
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_mobilenumber">Mobile Number</label>
                           <div class="col-sm-5">
                              <input type="text" class="form-control" id="emp_mobilenumber" name="emp_mobilenumber" placeholder="Mobile Number" />
                           </div>
                        </div>
                        <div class="form-group ">
                           <label class="col-sm-4 control-label" for="emp_gender">Gender</label>
                           
                             <div class="col-sm-5 radiomsg">
                              <input type="radio" name="emp_gender" value="M"> Male
                              <input type="radio" name="emp_gender" value="F"> Female
                            </div>


                          <!--  <div class="col-xs-1">
                              <label class="radio-inline">
                              <input type="radio" name="emp_gender" value="F"> Female
                              </label>
                           </div> -->
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_country">Coutry</label>
                           <div class="col-xs-5 col-sm-5 selectbox">
                              <select class="form-control" name="emp_country" id="emp_country">
                              	<option value="">Select Country</option>
                              	<?php 
			                        if(isset($country_data_arr) && !empty($country_data_arr)){
			                            foreach ($country_data_arr as $country_data_arr_key => $country_data_arr_value) {
			                    ?>
			                      <option value="<?php echo ($country_data_arr_value['id'])? $country_data_arr_value['id'] : '' ?>"><?php echo ($country_data_arr_value['country_name'])? $country_data_arr_value['country_name'] : '' ?></option> 	          			
                             	<?php
                             	 		}
                         			 }
                         	  	?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_state">State</label>
                           <div class="col-xs-5 col-sm-5 fillstate selectbox">
                              <select class="form-control" name="emp_state" id="emp_state">
                                 <option value="">Select State</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_city_name">City</label>
                           <div class="col-sm-5">
                              <input type="text" class="form-control" id="emp_city_name" name="emp_city_name" placeholder="City name" />
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_reporing_manager">Repoting Manager</label>
                           <div class="col-xs-5 col-sm-5 selectbox">
                              <select class="form-control" name="emp_reporing_manager" id="emp_reporing_manager">
                                 <option value="NULL">Repoting Manager</option>
                                 <?php echo $reportingMangerTreedata; ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_subject[]">Subject</label>
                           <div class="col-xs-5 col-sm-5 selectbox">
                              <select class="form-control mdb-select md-form" multiple name="emp_subject[]" id="emp_subject[]">
                              	<?php 
			                        if(isset($subjects_data_arr) && !empty($subjects_data_arr)){
			                            foreach ($subjects_data_arr as $subjects_data_arr_key => $subjects_data_arr_value) {
			                    ?>
			                      <option value="<?php echo ($subjects_data_arr_value['id'])? $subjects_data_arr_value['id'] : '' ?>"><?php echo ($subjects_data_arr_value['name'])? $subjects_data_arr_value['name'] : '' ?></option> 	          			
                             	<?php
                             	 		}
                         			 }
                         	  	?>
                             </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label" for="emp_image">Profile Image</label>
                           <div class="col-sm-5">
                              <input type="file" class="left" id="emp_image" name="emp_image" placeholder="Upload Image" />
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-9 col-sm-offset-4">
                              <button type="submit" class="btn btn-primary btnempsave" name="btnempsave" value="Save">Save</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript">
        
         $( document ).ready( function () {
         	
         	//add valiadation 
         	$("#frmemployee" ).validate( {
         		rules: {
         			"emp_name": "required",
         			"emp_image": {
         	            required:true,
                       extension: "jpg|jpeg|png|gif|JPEG|PNG|GIF"
         	        },
         			"emp_email": {
         				required: true,
         				email: true
         			},
         			"emp_mobilenumber":{
         				required: true,
         				number:true	
         			},
         			"emp_gender": "required",
         			"emp_country": "required",
         			"emp_state": "required",
         			"emp_city_name": "required",
         			"emp_subject[]": "required",
         		},
         		messages: {
         			emp_name: "Please enter your firstname",
         			emp_image: {
         				required: "Please Select file",
         				 extension:"select valide input file format"						
         			},
         			 
         			emp_email: "Please enter a valid email address",         		},
         			errorElement: "em",
	         		
	         		errorPlacement: function ( error, element ) {
	         			// Add the `help-block` class to the error element
	         			error.addClass( "help-block" );
	         
	         			// Add `has-feedback` class to the parent div.form-group
	         			// in order to add icons to inputs
	         			element.parents( ".col-sm-5" ).addClass( "has-feedback" );
	         
	         			if ( element.prop( "type" ) === "checkbox" ) {
	         				error.insertAfter( element.parent( "label" ) );
	         			}else if ( element.is(":radio") ){
	         				error.appendTo( $('.radiomsg') );
	         			}else if ( element.is("select") ){
	         				error.appendTo( element.parent('.selectbox') );
	         			}else {
	         				error.insertAfter( element );
	         			}
	         
	         			// Add the span element, if doesn't exists, and apply the icon classes to it.
	         			if ( !element.next( "span" )[ 0 ] ) {
	         				$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
	         			}
	         		},
	         		
	         		success: function ( label, element ) {
	         			// Add the span element, if doesn't exists, and apply the icon classes to it.
	         			if ( !$( element ).next( "span" )[ 0 ] ) {
	         				$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
	         			}
	         		},
	         		
	         		highlight: function ( element, errorClass, validClass ) {
	         			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
	         			$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
	         		},
	         		
	         		unhighlight: function ( element, errorClass, validClass ) {
	         			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
	         			$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
	         		},
	         		
	         		submitHandler: function(form) {
			            var formData = new FormData($('#frmemployee')[0]);
			            $.ajax({                
			                type : 'POST',
			                 processData: false,
    						contentType: false,
			                url  : 'response.php?action=add_employee_information',
			                data : formData,
			                success : function(response){
			                	if(response=='SUCCESS'){
			                		window.location.href = '<?php echo EMP_MANGEMENT_LIST_URL; ?>';
			                		$('#msg').html('');
			                	}else{
			                		$('#msg').html('Add Employee Information added fail');
			                	}
			                }
			            });
			            return false;
			        }
         		});
         	
         		//check validate email address 
	         	 $.validator.methods.email = function( value, element ) {
	         		return this.optional( element ) || /^\b[A+-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test( value );
	         	}

	         	//change country name then fill state dropdown
	         	$('#emp_country').off('change').on('change',function(){
	         	
		         	var country_id = $(this).val();
		         	data = {country_id:country_id}

		         	  $.ajax({                
		                type : 'POST',
		                url  : 'response.php?action=getStateListByCountryId',
		                data : data,
		                success : function(data){
		                	var stateselehtml = '';
		                	stateselehtml+='<select class="form-control" name="emp_state" id="emp_state">';
		                	stateselehtml+='<option value="">Select State</option>';
		                	if(data){
		                		var stateobj = jQuery.parseJSON(data);
		                        
		                		$.each(stateobj, function(key,val){
		                			stateselehtml+='<option value="'+val.id+'">'+val.name+'</option>';
		                		});
		                	}
		                	stateselehtml+='</select>';
		                	$('.fillstate').html(stateselehtml);
		                }
		            });
		         });
	         });
      </script>
   </body>
</html>