const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

menuBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'none';    
})

themeToggler.addEventListener('click', () =>{
    document.body.classList.toggle('dark-theme-variables');
    
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

})

const btnajuste = document.querySelector(".ajuste-info");
const closea = document.querySelector(".closeaaa");
const navigation = document.querySelector(".navigation");

btnajuste.addEventListener("click", () => {
    navigation.classList.add("active");
});

closea.addEventListener("click", () => {
    navigation.classList.remove("active");
});



