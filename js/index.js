window.addEventListener("load", myFunction);
function myFunction() {
    let menu = document.querySelector("#links");
    if (menu.style.display === "grid") {
        menu.style.display = "none";
    } else {
        menu.style.display = "grid";
    }
}