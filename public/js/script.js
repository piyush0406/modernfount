/*!
    * Start Bootstrap - SB Admin v6.0.1 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

function editInfo(){
  document.getElementById("form-editable").style.display = "block"
  document.getElementById("form-non-editable").style.display = "none"

  document.getElementById("name").value= document.getElementById("name_label").innerHTML
  document.getElementById("email").value= document.getElementById("email_label").innerHTML
  document.getElementById("mobile").value= document.getElementById("phone_label").innerHTML
  document.getElementById("about").value= document.getElementById("about_label").innerHTML
  document.getElementById("qualification").value= document.getElementById("qualification_label").innerHTML
  document.getElementById("expertise").value= document.getElementById("expertise_label").innerHTML

}

function submitInfo(){
   document.getElementById("form-editable").style.display = "none"
   document.getElementById("form-non-editable").style.display = "block"
 }

function changeData(){

  var author_dropdown=document.getElementById("authorList")
  var author= author_dropdown.options[author_dropdown.selectedIndex].id
  document.getElementById("user_id").value=author
  console.log(author_dropdown.options[author_dropdown.selectedIndex].id)


}

function submitSecond(id){
  //document.getElementById("displaytest").innerHTML=document.getElementById("secondtest").value
  author_id=id.substring(1,id.length)
  document.getElementById(author_id).click()
}

function submitHero(id){
  //document.getElementById("displaytest").innerHTML=document.getElementById("secondtest").value
  author_id=id.substring(1,id.length)
  document.getElementById('b'+author_id).click()
}

function editImg(){
  document.getElementById("imgupload").style.display = "block"
}
