const body = document.body;
const title = document.getElementById("title");
const storedTheme = localStorage.getItem("theme") || "cheese";

body.className = storedTheme;

function updateTitle() 
{
    if (body.classList.contains("cheese")) 
    {
        title.innerHTML = "<b class='special'>Cheese</b>Cards <b class='special'>!</b>";
    } 
    else if (body.classList.contains("meat")) 
    {
        title.innerHTML = "<b class='special'>Meat</b>Cards <b class='special'>!</b>";
    }
}

function theme_select() 
{
    if (body.classList.contains("cheese")) 
    {
        body.classList.replace("cheese", "meat");
        localStorage.setItem("theme", "meat");
    } 
    else 
    {
        body.classList.replace("meat", "cheese");
        localStorage.setItem("theme", "cheese");
    }
    updateTitle();
}

updateTitle();
updateMain();