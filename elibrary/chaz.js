function validateForm() {


    var password = document.getElementById("psw").value;
    var cpassword = document.getElementById("psw-repeat").value;
    
         if(password == null || password == "" ){
         alert("pasword must be filled");
            return false;
     }
    
    
     if(password.length < 6){
        alert("atleast 6 characters required");
        return false;
    }
    
    
        if(cpassword == null || cpassword == "" ){
            alert("repeat pasword must be filled");
            return false;
        }
    
    
        if ( password != cpassword) {
            alert("The password isn't a match");
            return false;
            }
            else{
                return true;
            }
    
    
        }