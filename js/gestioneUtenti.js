window.onload = () => {
    document.getElementById("frmUtenti").onsubmit = event => {
        event.preventDefault();
        check(event.target);
    };
};
function check(form) {
    const oldPwd = document.getElementById("passwordAttuale").value;
    const newPwd = document.getElementById("passwordNuova").value;
    const confirmPwd = document.getElementById("confirmPassword").value;
    let errorDiv = document.createElement("div");
    errorDiv.id = "errors";
    errorDiv.className = "linea";
    errorDiv.tabIndex = -1;
    let errorAnchor = document.createElement("a");
    errorAnchor.tabIndex = 0;
    if (oldPwd == ""){
        errorAnchor.innerText = "Inserire la vecchia password";
        errorAnchor.onclick = () => clickFocus("passwordAttuale");
        errorAnchor.onkeyup = event => keyFocus(event,"passwordAttuale");
        errorDiv.appendChild(errorAnchor);
    }
    else {
        if (newPwd == ""){
            errorAnchor.innerText = "Inserire la nuova password";
            errorAnchor.onclick = () => clickFocus("passwordNuova");
            errorAnchor.onkeyup = event => keyFocus(event,"passwordNuova");
            errorDiv.appendChild(errorAnchor);
        }
        else {
            if (confirmPwd !== newPwd){
                errorAnchor.innerText = "La conferma non coincide con la nuova password";
                errorAnchor.onclick = () => clickFocus("confirmPassword");
                errorAnchor.onkeyup = event => keyFocus(event,"confirmPassword");
                errorDiv.appendChild(errorAnchor);
            }
        }
    }
    if(errorDiv.hasChildNodes()){
        if(document.getElementById("errors"))
            document.getElementById("errors").remove();
        form.prepend(errorDiv);
        errorDiv.focus();
    }
    else{
        form.submit();
    }
}

// TODO remove if useless
function addUser(){
    let addUser = document.getElementById('addUser').value;
    let fPwd = document.getElementById('firstPassword').value;
    let cPwd = document.getElementById('confirmPassword').value;
    if(addUser===""){
        alert("Username non inserito");
    }
    if(fPwd===""){
        alert("Password non inserita");
    }
    if(cPwd===""){
        alert("Password non inserita");
    }
    if(cPwd!=fPwd){
        alert("Le due password non corrispondono");
    }
}