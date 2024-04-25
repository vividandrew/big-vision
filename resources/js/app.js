import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// !! BURGER MENU !!
 var closed = document.getElementById("AWBurgerClosed");
 var open = document.getElementById("AWBurgerOpen");
var menu = document.getElementById("mobile-menu")

 document.getElementById("AWMenuButton").addEventListener("click",function (){
     if(closed.classList.contains("block"))
     {
         closed.classList.remove("block");
         closed.classList.add("hidden");

         open.classList.add("block");
         open.classList.remove("hidden");

        menu.classList.remove("hidden");
     }else{

         closed.classList.remove("hidden");
         closed.classList.add("block");

         open.classList.add("hidden");
         open.classList.remove("block");

         menu.classList.add("hidden");
     }
})

//Profile Menu
var pmenu = document.getElementById("profile-menu");

document.getElementById("user-menu-button").addEventListener("click",function()
{
    if(pmenu.classList.contains("hidden"))
    {
        pmenu.classList.remove("hidden")
    }else{
        pmenu.classList.add("hidden")
    }
})
