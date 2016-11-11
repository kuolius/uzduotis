
$().ready(function(){
    
    $("#signinForm").validate({
        rules:{
            username: "required",
            password: "required"
        },
        messages:{
            username: "Please enter your username.",
            password: "Please enter your password."
        },
        errorElement: "div"
        
    });
    
    $("#signupForm").validate({
        rules:{
            username: "required",
            password:{
                required:true,
                minlength:6,
                maxlength:20
            },
            password_conf:
            {
                equalTo:"#password"
            }
        },
        messages:{
            username: "Please enter your username.",
            password:{
                required:"Please enter your password.",
                minlength:"Password must consist at least of 6 characters.",
                maxlength:"Password length has to be less than 20 chars."
            },
            password_conf:"Confirmation password doesn't match password."
        },
        errorElement: "div"
        
    });
});

