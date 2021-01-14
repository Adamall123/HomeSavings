//go to registerloginpage
$(document).ready(function(){
   $("#getStarted").click(function(){
       $('main').load("register.html");
   })
});
$(document).ready(function(){
   $("#login").click(function(){
       $('main').load("login.html");
   })
});


$(document).ready(function(){
   $("#mainPage").click(function(){
       $('main').load("mainPage.html");
       $('footer').html("")
       
   })
});