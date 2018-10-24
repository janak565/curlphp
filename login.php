<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Simple Login Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form id="loginfrm" name="loginfrm" action="" method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group loginfrmvalidation">
            <input type="text" class="form-control" placeholder="Email Address" name="useremail" id="useremail">
        </div>
        <div class="form-group loginfrmvalidation">
            <input type="password" class="form-control" placeholder="Password" name="userpass" id="userpass">
        </div>
        <div class="form-group">
            <button type="submit" name="btnlogin" id="btnlogin" class="btn btn-primary btn-block btnlogin">Log in</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
        </div>        
    </form>
</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">              
                <h4 class="modal-title">Opt Number</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post" name="loginoptfrm" id="loginoptfrm">
                    <div class="form-group optfrmvalidation">
                        <input type="text" class="form-control" placeholder="OPT Number" id="optnumber" name="optnumber">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Submit">
                    </div>
                </form>             

            </div>
        </div>
    </div>
</div>     
    <a href="#myModal" class="trigger-btn" data-toggle="modal">Click to Open Login Modal</a>
<script type="text/javascript">

    $( "#loginoptfrm" ).validate( {
        rules: {
            optnumber: {
                    required: true,
                    number:true
                }
        },
        messages: {
             optnumber: {
                required: "Opt Number is required",
                number: "Please enter number not characters"
            },
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            //alert('ts');
            $(".glyphicon").show();
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents( ".optfrmvalidation" ).addClass( "has-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !element.next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
            }
        },
        success: function ( label, element ) {
            //alert('ts222');
            $(".glyphicon").show();
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !$( element ).next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $(".glyphicon").show();
            $( element ).parents( ".optfrmvalidation" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
            $(".glyphicon").show();
            $( element ).parents( ".optfrmvalidation" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        },
        submitHandler: function(form) {
            var data = $("#loginoptfrm").serialize();
            $.ajax({                
                type : 'POST',
                url  : 'response.php?action=checkopt',
                data : data,
                // beforeSend: function(){ 
                //     $("#error").fadeOut();
                //     $("#login_button").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                // },
                success : function(response){   
                      if(response=='SUCCESS'){
                        window.location.href="http://localhost/admi";
                      }  
                    // if($.trim(response) === "1"){
                    //     console.log('dddd');                                    
                    //     $("#login-submit").html('Signing In ...');
                    //     setTimeout(' window.location.href = "dashboard.php"; ',2000);
                    // } else {                                    
                    //     $("#error").fadeIn(1000, function(){                        
                    //         $("#error").html(response).show();
                    //     });
                    // }
                }
            });
            return false;
        }
    });

    $( "#loginfrm" ).validate( {
        rules: {

            useremail: {
                    required: true,
                    email: true,
                },
            userpass: {
                    required: true,
                    minlength: 6
            },
        },
        messages: {

             useremail: {
                required: "Email address is required",
                email: "Please enter a valid email address"
            },
            userpass: {
                required: "paassword is required",
                minlength: "Your password must be at least 5 characters long"
            }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            alert('tes');
            $(".glyphicon").show();
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents( ".loginfrmvalidation" ).addClass( "has-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !element.next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
                $(".glyphicon").show();
            }
        },
        success: function ( label, element ) {
            
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if ( !$( element ).next( "span" )[ 0 ] ) {
                $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
                $(".glyphicon").show();
    
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".loginfrmvalidation" ).addClass( "has-error" ).removeClass( "has-success" );
            $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".loginfrmvalidation" ).addClass( "has-success" ).removeClass( "has-error" );
            $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        },
        submitHandler: function(form) {
            var data = $("#loginfrm").serialize();
            $.ajax({                
                type : 'POST',
                url  : 'response.php?action=login',
                data : data,
                // beforeSend: function(){ 
                //     $("#error").fadeOut();
                //     $("#login_button").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                // },   
                success : function(response){
                $('#myModal').modal('show'); 
                $('#loginoptfrm').trigger("reset");

            var validator = $( "#loginoptfrm" ).validate();
            validator.resetForm();
            $( ".optfrmvalidation " ).removeClass( "has-error has-success has-feedback" );
            $(".glyphicon ").hide();

                //$('')           
                    // if($.trim(response) === "1"){
                    //     console.log('dddd');                                    
                    //     $("#login-submit").html('Signing In ...');
                    //     setTimeout(' window.location.href = "dashboard.php"; ',2000);
                    // } else {                                    
                    //     $("#error").fadeIn(1000, function(){                        
                    //         $("#error").html(response).show();
                    //     });
                    // }
                }
            });
            return false;
        }
    });
     
    $.validator.methods.email = function( value, element ) {
        return this.optional( element ) || /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test( value );
    }

</script>
</body>
</html>                                		                            