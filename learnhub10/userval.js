    function checkForm(form) 
    { 
        //Username is blank validation
        if(form.username.value == "") 
        { 
            alert("Username cannot be blank!");
            form.username.focus();
            return false; 
        }
        //Password is blank validation
        if (form.password.value == "")
        {
                alert("Password cannot be blank");
                form.password.focus();
                return false;
        }
        //Confirm Password is blank validation
        if(form.cpassword.value=="")
        {
                alert("Please confirm your password");
                form.cpassword.focus();
                return false;
        }
        // First Name is blank validation
        if (form.fname.value=="")
        {
                    alert("First Name cannot be blank");
                    form.fname.focus();
                    return false;
        }
        //Last Name is balnk validation
        if (form.lname.value=="")
        {
            alert("Last Name cannot be blank");
            form.lname.focus();
            return false;
        }
        // Email is blank validation
        if (form.email.value=="")
        {
            alert("Email cannot be blank");
            form.email.focus();
            return false;
        }
                
        re = /^\w+$/;
        // Username Character Validation
        if(!re.test(form.username.value)) 
        { 
            alert("Username must contain only letters, numbers and underscores!"); 
            form.username.focus(); 
            return false; 
        }
        if(form.username.value.length<6)
        {
            alert("Username must be atleast six characters");
            form.username.focus();
            return false;
        }
        // Password not null and password equal to confirm password validation
        if(form.password.value == form.cpassword.value) 
        { 
            //Password lenght Validation
            if(form.password.value.length < 6) 
            { 
                alert("Password must contain at least six characters!"); 
                form.password.focus(); 
                return false; 
            } 
            //Password not equal to username validation
            if(form.password.value == form.username.value) 
            { 
                alert("Password must be different from Username!"); 
                form.password.focus(); 
                return false; 
            } 
            re = /[0-9]/; 
            //Password contains number validation
            if(!re.test(form.password.value)) 
            { 
                alert("Password must contain at least one number (0-9)!"); 
                form.password.focus(); 
                return false; 
            } 
            re = /[a-z]/; 
            //Password contains lowercase letters validation
            if(!re.test(form.password.value)) 
            { 
                alert("Password must contain at least one lowercase letter (a-z)!"); 
                form.password.focus(); 
                return false; 
            } 
            re = /[A-Z]/; 
            //Password contains uppercase letters validation
            if(!re.test(form.password.value)) 
            { 
                alert("Password must contain at least one uppercase letter (A-Z)!"); 
                form.password.focus(); 
                return false; 
            } 
        } 
        else 
        { 
            alert("Password and confirm password do not match"); 
            form.password.focus(); 
            return false; 
        }
        //Email Validation Script
        var x=document.forms["userform"]["email"].value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
        {
          alert("Not a valid e-mail address");
          return false;
        }
}


