window.onload = function () {

    if (location.href.includes("index.php")) {
        Array.from(document.querySelector("table").querySelectorAll("th:nth-child(5)")).forEach(el => el.style.display = "none");
        Array.from(document.querySelector("table").querySelectorAll("td:nth-child(5)")).forEach(el => el.style.display = "none");

    }

    let adresa = (location.href.split("\/"));
    adresa = adresa[adresa.length - 1];
    Array.from(document.querySelectorAll("nav ul li a")).forEach(el => {
        if (location.href.includes(el.href)) {
            el.parentElement.id = "aktivni";
        }
    });

    console.log(location.href);



    // document.querySelector("nav ul li").style.backgroundColor = "rgba(176, 176, 248, 0.562)";
    // document.querySelector("nav li a").style.color = "black";

};