/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
};

jQuery.fn.readImageForUpload = function(imgId)
{
   var imgId = "#" + imgId;
   this.on("change", function (event) {
        var reader = new FileReader();
        $(reader).load(function (event) {
            $(imgId).attr("src", event.target.result);
            console.log(imgId);
        });
        reader.readAsDataURL(event.target.files[0]);
     });  
};