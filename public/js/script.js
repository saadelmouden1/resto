import Swiper from 'https://unpkg.com/swiper@8/swiper-bundle.esm.browser.min.js'

let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}

let section = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header .navbar a');

window.onscroll = () =>{

  menu.classList.remove('fa-times');
  navbar.classList.remove('active');

  section.forEach(sec =>{

    let top = window.scrollY;
    let height = sec.offsetHeight;
    let offset = sec.offsetTop - 150;
    let id = sec.getAttribute('id');

    if(top >= offset && top < offset + height){
      navLinks.forEach(links =>{
        links.classList.remove('active');
        document.querySelector('header .navbar a[href*='+id+']').classList.add('active');
      });
    };

  });

}

document.querySelector('#search-icon').onclick = () =>{
  document.querySelector('#search-form').classList.toggle('active');
}

document.querySelector('#close').onclick = () =>{
  document.querySelector('#search-form').classList.remove('active');
}

var swiper = new Swiper(".home-slider", {
  
  autoplay: {
    delay: 7500,
    disableOnInteraction: false,
  },
  pagination: {
    // el: ".swiper-pagination",
    // clickable: true,
    
  },
  loop:true,
});

var swiper = new Swiper(".review-slider", {
  spaceBetween: 80,
  centeredSlides: true,
  autoplay: {
    delay: 7500,
    disableOnInteraction: false,
  },
  loop:true,
  breakpoints: {
    0: {
        slidesPerView: 1,
    },
    640: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

function loader(){
  document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut(){
  setInterval(loader, 3000);
}

window.onload = fadeOut;



// const s=document.querySelector(".slider");

// const cont=document.querySelector('.content');
// const nav=document.querySelector('.navbar');
// const lists=nav.children
// const spans= document.querySelectorAll(".wt")
// const btns= document.querySelectorAll(".rt")
// console.log(spans);
// let a=0;

// const chil=document.body.children;
// console.log(chil);

// s.addEventListener('click',()=>{
//   if(a===0){
//      for(let i = 0;i<chil.length;i++){
//        chil[i].style.backgroundColor="#1b1c1c";
    
//      }
  
     
//      for(let i = 0;i<spans.length;i++){
//       spans[i].style.color="#fff";
   
//     }
//     for(let i = 0;i<lists.length;i++){
      
//       lists[i].classList.add('cl')
      
//     }
//     for(let i = 0;i<btns.length;i++){
//       btns[i].style.color="black";
//       btns[i].style.backgroundColor="#fff";
//     }

   
//     a=1;
//   }
//   else{
//     for(let i = 0;i<chil.length;i++){
//       chil[i].style.backgroundColor="#eee";
    

//     }
//     chil[0].style.backgroundColor="#fff";
//     chil[2].style.backgroundColor="#fff";
//     chil[4].style.backgroundColor="#fff";
//     chil[6].style.backgroundColor="#fff";
//     for(let i = 0;i<spans.length;i++){
//       spans[i].style.color="#0d0d0d";
   
//     }
//     for(let i = 0;i<lists.length;i++){
      
//       lists[i].classList.remove('cl')
   
//     }

//     for(let i = 0;i<btns.length;i++){
//       btns[i].style.color="#fff";
//       btns[i].style.backgroundColor="#0d0d0d";
//     }
    
//     a=0;
//   }
// })


/*************************************************************/
/********************scroll ***************************/
/**************************************************************/
const link=document.querySelector(".link");
window.addEventListener('scroll',showIcon)
showIcon()
function showIcon(){


  const top=link.getBoundingClientRect().top
  if(window.pageYOffset>100){
    link.classList.add("act")
  }
else {
    link.classList.remove("act")
}
}

// USER ACCOUNT
let userBox = document.querySelector('.account-box');

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
    navbar.classList.remove('active');
}
