window.onload = () => {
    document.getElementById("frmupdate").onsubmit = event => {
        event.preventDefault();
        check(event.target);
    };
};
function check(form){
    let totale = document.getElementById('finalTot').value;
    let expNumb = new RegExp('^[0-9]+.[0-9]{2}$');
    if(!expNumb.test(totale)){
        let errorDiv = document.getElementById("errors");
        if(errorDiv)
            document.getElementById("errors").remove();
        errorDiv = document.createElement("div");
        errorDiv.className = "linea";
        errorDiv.id = "errors";
        errorDiv.tabIndex = -1;
        let errorAnchor = document.createElement("a");
        errorAnchor.id = "errorAnchor";
        errorAnchor.onkeyup = event => keyFocus(event,"finalTot");
        errorAnchor.onclick = () => clickFocus("finalTot");
        errorAnchor.innerText = "Importo mancante o inserito non correttamente";
        errorAnchor.tabIndex = 0;
        errorDiv.appendChild(errorAnchor);
        if(document.getElementById("errors"))
            document.getElementById("errors").remove();
        form.insertBefore(errorDiv,form.childNodes[0]);
        errorDiv.focus();
    }
    else
        form.submit();
}