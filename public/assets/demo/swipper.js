// var swipper = new Swiper(".slide-content",{
//     slidesPerView:3,
//     spaceBetween:30,
//     slidesPerGroup:3,
//     loop:true,
//     loopFillGroupWithBlank:true,
//     pagination:{
//         el:".swiper-pagination",
//         clickable:true,
//     },
//     navigation:{
//         nextEl:".swipper-button-next",
//         prevEl:".swipper-button-prev",
//     },
// })

var swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
});

