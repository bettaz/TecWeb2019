window.onload = () =>{
    document.getElementById("frmLogin").onsubmit = event => {
        event.preventDefault();
        check(event.target);
    };
};
const suggestions = {
    "uname": "Inserire l'username",
    "password": "Inserire la password"
};
function check(form){
    let name = document.getElementById('uname').value;
    let pwd = document.getElementById('password').value;
    let tag = "";
    if(pwd === "" || name ===""){
        if(name==="")
            tag="uname";
        else
            tag="password";
        let errorDiv = document.getElementById("errors");
        if(errorDiv)
            document.getElementById("errors").remove();
        errorDiv = document.createElement("div");
        errorDiv.id = "errors";
        errorDiv.className = "linea";
        errorDiv.tabIndex=0;
        let paragraph = document.createElement("p");
        let anchor = document.createElement("a");
        anchor.tabIndex = 0;
        anchor.onclick = () => clickFocus(tag);
        anchor.onkeyup = event => keyFocus(event,tag);
        anchor.innerText = suggestions[tag];
        paragraph.appendChild(anchor);
        errorDiv.appendChild(paragraph);
        if (document.getElementById("errors"))
            document.getElementById("errors").remove();
        document.getElementById("content").insertBefore(errorDiv,document.getElementById("usrdiv"));
        errorDiv.focus();
    }
    else {
        form.submit();
    }
}
