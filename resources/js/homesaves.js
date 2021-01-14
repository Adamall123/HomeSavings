//go to registerloginpage
$(document).ready(function(){
   $("#getStarted").click(function(){
       $('.container main').load("register.html");
   })
});
$(document).ready(function(){
   $("#login").click(function(){
       $('.container main').load("login.html");
   })
});