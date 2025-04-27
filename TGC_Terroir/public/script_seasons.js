const body = document.body;
const storedTheme = localStorage.getItem("theme") || "cheese"; 
body.className = storedTheme;

function theme_select() {
    if (body.className === "cheese aos-init aos-animate") {
        body.className = "meat aos-init aos-animate";
        localStorage.setItem("theme", "meat");
    } else {
        body.className = "cheese aos-init aos-animate";
        localStorage.setItem("theme", "cheese");
    }
}
