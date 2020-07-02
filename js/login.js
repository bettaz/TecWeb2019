window.onload = event =>{
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
        let errors = document.createElement("div");
        errors.id = "errors";
        errors.className = "linea";
        errors.tabIndex=0;
        let paragraph = document.createElement("p");
        let anchor = document.createElement("a");
        anchor.tabIndex = 0;
        anchor.onclick = () => clickFocus(tag);
        anchor.onkeyup = event => keyFocus(event,tag);
        anchor.innerText = suggestions[tag];
        paragraph.appendChild(anchor);
        errors.appendChild(paragraph);
        if (document.getElementById("errors"))
            document.getElementById("errors").remove();
        document.getElementById("content").insertBefore(errors,form);
        errors.focus();
    }
    else {
        form.submit();
    }
}
function clickFocus(tagName) {
    document.getElementById(tagName).focus();
}
function keyFocus(keyEvent, tagName) {
    if(keyEvent.key == "Enter"){
        keyEvent.preventDefault();
        clickFocus(tagName);
    }
}


