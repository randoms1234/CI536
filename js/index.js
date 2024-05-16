window.addEventListener("load", myFunction);
let count = 0
function myFunction() {
    let menu = document.querySelector("#links");
    const menuborder = document.querySelector("header");
    if (menu.style.display === "grid") {
        menu.style.display = "none";
        menuborder.style.borderBottom = "1px solid black";
        count++
    } else {
        menu.style.display = "grid";
        if (count !== 0){
            menuborder.style.borderBottom = "0";
        }

    }
}