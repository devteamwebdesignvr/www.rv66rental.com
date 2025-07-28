$(document).ready(function() {

    var max = 80;

    $(".readMore").each(function() {

        var str = $(this).text();

        if ($.trim(str).length > max) {

            var subStr = str.substring(0, max);

            var hiddenStr = str.substring(max, $.trim(str).length);

            $(this).empty().html(subStr);

            $(this).append(' <a href="javascript:void(0);" class="link">Read more…</a>');

            $(this).append('<span class="addText">' + hiddenStr + '</span>');

        }

    });

    $(".link").click(function() {

        $(this).siblings(".addText").contents().unwrap();

        $(this).remove();

    });

});


$(document).ready(function(){
        //length in characters
    var maxLength = 500;
    var ellipsestext = "...";
    var moretext = "Read more";
    var lesstext = "Read less";
    $(".showReadMores").each(function(){
        //get the text of paragraph or div
        var myStr = $(this).text();
        
       // check if it exceeds the maxLength limit
        if($.trim(myStr).length > maxLength){
            //get only limited string firts to show text on page load
            var newStr = myStr.substring(0, maxLength);

            //get remaining string         
 var removedStr = myStr.substr(maxLength, $.trim((myStr).length + 1) - maxLength);
            // now append the newStr + "..."+ hidden remaining string
            var Newhtml = newStr + '<span class="moreellipses">' + ellipsestext+ '</span><span class="morecontent"><span>' + removedStr + '</span>&nbsp;&nbsp;<a href="javascript:void(0)" class="ReadMore">' + moretext + '</a></span>';
 
            $(this).html(Newhtml);
            
        }
    });
    
    //function to show/hide remaining text on ReadMore button click
    $(".ReadMore").click(function(){
       
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        }
         else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
