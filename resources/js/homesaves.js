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
   $("#logout").click(function(){
       $('main').load("login.html"); 
   })
});


$(document).ready(function(){
   $(".mainPage").click(function(){
       $('main').load("mainPage.html"); 
   })
});

$(document).ready(function(){
   $(".income").click(function(){
       $('main').load("income.html"); 
   })
});

$(document).ready(function(){
   $(".expence").click(function(){
       $('main').load("expence.html"); 
   })
});
$(document).ready(function(){
   $(".settings").click(function(){
       $('main').load("settings.html"); 
   })
});
$(document).ready(function(){
   $(".balance").click(function(){
       $('main').load("balance.html"); 
   })
});