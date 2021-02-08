//go to registerloginpage

/*
$(document).ready(function () {
    $("#getStarted").click(function () {
        $('main').fadeOut("slow", function(){
            $('main').load("register.php").fadeIn("slow");
            //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed            
        })
    })
});
$(document).ready(function () {
    $("#login").click(function () {
        $('main').fadeOut("slow", function(){
            //$('main').load("/login.php").fadeIn("slow");
			$('main').load("login.php").fadeIn("slow");
            //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed
        })
    })
});
*/
/*
$(document).ready(function () {
    $(".logout").click(function () {
		 $('main').fadeOut("slow", function(){
			$('main').load("login.php").fadeIn("slow");
			//$('nav').css("display", "none");
            //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed
			//if clicked too many times it is loading whole file and then changing div 
        })
        
    })
});
*/
/*
$(document).ready(function () {
    $(".mainPage").click(function () {
		$('main').fadeOut("slow", function(){
            //$('main').load("/login.php").fadeIn("slow");
			$('main').load("mainPage.php").fadeIn("Slow");
        $('nav').css("display", "block");
            //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed
        })
        
        $('a:first').addClass("active");
        $('a:nth-child(2)').removeClass("active");
        $('a:nth-child(3)').removeClass("active");
        $('a:nth-child(4)').removeClass("active");
        $('a:nth-child(5)').removeClass("active");
        //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed
    })
});
*/
$(document).ready(function () {
    $(".income").click(function () {
        $('main').load("income.php");
        $('a:nth-child(3)').addClass("active");
        $('a:first').removeClass("active");
        $('a:nth-child(2)').removeClass("active");
        $('a:nth-child(4)').removeClass("active");
        $('a:nth-child(5)').removeClass("active");
        //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed
    })
});

$(document).ready(function () {
    $(".expence").click(function () {
        $('main').load("expence.php");
        $('a:nth-child(4)').addClass("active");
        $('a:first').removeClass("active");
        $('a:nth-child(2)').removeClass("active");
        $('a:nth-child(3)').removeClass("active");
        $('a:nth-child(5)').removeClass("active");
        //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed
    })
});
/*
$(document).ready(function () {
    $(".settings").click(function () {
        $('main').load("settings.php");
        $('a:nth-child(5)').addClass("active");
        $('a:first').removeClass("active");
        $('a:nth-child(2)').removeClass("active");
        $('a:nth-child(3)').removeClass("active");
        $('a:nth-child(4)').removeClass("active");
        //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed
    })
});
*/
$(document).ready(function () {
    $(".balance").click(function () {
        $('main').load("balance.php");
        $('a:first').removeClass("active");
        $('a:nth-child(2)').addClass("active");
        $('a:nth-child(3)').removeClass("active");
        $('a:nth-child(4)').removeClass("active");
        $('a:nth-child(5)').removeClass("active");
        //issue loadging page login.html and after display briefly page changing div conent and displaying what it wanted to being displayed
    })
});



