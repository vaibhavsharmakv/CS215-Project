var q = document.getElementById("Message");

q.addEventListener("keydown",messageCount,false);
q.addEventListener("keyup",messageCount,false);

var secretMessageValidation =document.getElementById("button");

secretMessageValidation.addEventListener("click",functionset4,false);

var pS = document.getElementById("secretCode");

pS.addEventListener("keyup",suggest,false);



