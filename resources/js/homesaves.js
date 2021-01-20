//go to registerloginpage
$(document).ready(function () {
    $("#getStarted").click(function () {
        $('main').load("register.html");
    })
});
$(document).ready(function () {
    $("#login").click(function () {
        $('main').load("login.html");
    })
});
$(document).ready(function () {
    $(".logout").click(function () {
        $('main').load("login.html");
        $('nav').css("display", "none");
    })
});


$(document).ready(function () {
    $(".mainPage").click(function () {
        $('main').load("mainPage.html");
        $('nav').css("display", "block");
        $('a:first').addClass("active");
        $('a:nth-child(2)').removeClass("active");
        $('a:nth-child(3)').removeClass("active");
        $('a:nth-child(4)').removeClass("active");
        $('a:nth-child(5)').removeClass("active");
    })
});

$(document).ready(function () {
    $(".income").click(function () {
        $('main').load("income.html");
        $('a:nth-child(3)').addClass("active");
        $('a:first').removeClass("active");
        $('a:nth-child(2)').removeClass("active");
        $('a:nth-child(4)').removeClass("active");
        $('a:nth-child(5)').removeClass("active");
    })
});

$(document).ready(function () {
    $(".expence").click(function () {
        $('main').load("expence.html");
        $('a:nth-child(4)').addClass("active");
        $('a:first').removeClass("active");
        $('a:nth-child(2)').removeClass("active");
        $('a:nth-child(3)').removeClass("active");
        $('a:nth-child(5)').removeClass("active");
    })
});
$(document).ready(function () {
    $(".settings").click(function () {
        $('main').load("settings.html");
        $('a:nth-child(5)').addClass("active");
        $('a:first').removeClass("active");
        $('a:nth-child(2)').removeClass("active");
        $('a:nth-child(3)').removeClass("active");
        $('a:nth-child(4)').removeClass("active");
    })
});
$(document).ready(function () {
    $(".balance").click(function () {
        $('main').load("balance.html");
        $('a:first').removeClass("active");
        $('a:nth-child(2)').addClass("active");
        $('a:nth-child(3)').removeClass("active");
        $('a:nth-child(4)').removeClass("active");
        $('a:nth-child(5)').removeClass("active");
    })
});



