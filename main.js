$(function(){

    
    $(".btn-dark").click(function(){
        $(".navbar").css({"background-color" : "black"});
        $("body").css({"background-color" : "black"});
        $(".card").css({"background-color" : "black"});
        $("td").css({"color" : "white"});
        $("th").css({"color" : "white"});
        $("a").css({"color" : "white"});
    })
    $(".btn-light").click(function(){
        $(".navbar").css({"background-color" : ""});
        $("body").css({"background-color" : ""});
        $(".card").css({"background-color" : ""});
        $("td").css({"color" : ""});
        $("th").css({"color" : ""});
        $("a").css({"color" : ""});
    })
});