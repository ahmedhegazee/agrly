window.onload=function (){
    "use strict";
    var password = document.getElementById("pass"),
    cpassword = document.getElementById("passconf"),
    msgp = document.getElementById("msgp"),
    msgcp = document.getElementById("msgcp"),
        form = document.getElementById("change");
    
    
    password.onkeyup=function(){
        
        if(password.value.length<7)
        {
            
            msgp.style.display="inline";
            msgp.style.color="#F00";
            if(!form.hasAttribute("onsubmit"))
            form.setAttribute("onsubmit","event.preventDefault();");
        }
        else{
            msgp.style.color="#080";
            if(form.hasAttribute("onsubmit"))
            form.removeAttribute("onsubmit");
        }
    };
    cpassword.onkeyup=function(){
        if (password.value != cpassword.value)
        {
            msgcp.style.display="inline";
            msgcp.style.color="#F00";
            if(!form.hasAttribute("onsubmit"))
            form.setAttribute("onsubmit","event.preventDefault();");

        }
        else{
            msgcp.style.color="#080";
            if(form.hasAttribute("onsubmit"))
            form.removeAttribute("onsubmit");

        }
    }
}