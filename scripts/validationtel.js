window.onload=function(){
    "use strict";
   var tel =document.getElementById("txttel"),
    msgtel = document.getElementById("msgtel"),
        form = document.getElementById("form");
    tel.onkeyup=function(){
        msgtel.style.display="inline";
        if (tel.value.length==10)
        {
            //console.log("finish");
            msgtel.style.color="#080";
            if(form.hasAttribute("onsubmit"))
            form.removeAttribute("onsubmit");
            

        }
        else{
            //console.log(tel.textContent);
            msgtel.style.color="#F00";
            if(!form.hasAttribute("onsubmit"))
            form.setAttribute("onsubmit","event.preventDefault();");
        }
    };
}