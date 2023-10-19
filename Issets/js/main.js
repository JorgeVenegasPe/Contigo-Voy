const menuBtn = document.querySelector(".ajuste-info");
const closea = document.querySelector(".closeaaa");
const navigation = document.querySelector(".navigation");

menuBtn.addEventListener("click", () => {
    navigation.classList.add("active");
});

closea.addEventListener("click", () => {
    navigation.classList.remove("active");
});
