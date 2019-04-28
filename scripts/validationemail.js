window.onload=function(){
    "use strict";
    var email = document.getElementById("txtemail"),
        cemail = document.getElementById("txtcemail"),
        msg = document.getElementById("msgemail"),
        form = document.getElementById("form");
        cemail.onkeyup=function(){
            if (email.value != cemail.value)
            {
                console.log("finish");
                msg.style.display="inline";
                msg.style.color="#F00";
                if(!form.hasAttribute("onsubmit"))
                form.setAttribute("onsubmit","event.preventDefault();");
    
            }
            else{
                msg.style.color="#080";
                if(form.hasAttribute("onsubmit"))
                form.removeAttribute("onsubmit");
    
            }
    
        };
    }