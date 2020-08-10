window.onload = () => {
    document.getElementById("frmCerimonia").onsubmit = event => {
        event.preventDefault();
        checkInsert(event.target);
    };
};

// TODO da controllare

function checkInsert(form){
    const tipo = document.getElementById('tipolog').value;
    const prezzo = document.getElementById('prezzoC').value;
    // TODO migliorare la regex aggiungendo punto e virgola
    let expNumb = new RegExp('[0-9]+$');

    let errorDiv = document.getElementById("errors");
    if(errorDiv)
        document.getElementById("errors").remove();
    errorDiv = document.createElement("div");
    errorDiv.id = "errors";
    errorDiv.className = "linea";
    errorDiv.tabIndex = -1;
    let errorAnchor = document.createElement("a");
    errorAnchor.tabIndex = 0;
    if(tipo == ''){
        errorAnchor.innerText = "Inserire i dettagli del tipo di cerimonia";
        errorAnchor.onclick = () => clickFocus("tipolog");
        errorAnchor.onkeyup = event => keyFocus(event,"tipolog");
        errorDiv.appendChild(errorAnchor);
    } else {
        if(prezzo == ''){
            errorAnchor.innerText = "Inserire il prezzo della cerimonia";
            errorAnchor.onclick = () => clickFocus("prezzoC");
            errorAnchor.onkeyup = event => keyFocus(event,"prezzoC");
            errorDiv.appendChild(errorAnchor);
        } else {
            if(!expNumb.test(prezzo)){
                errorAnchor.innerText = "Il prezzo inserito non e' corretto";
                errorAnchor.onclick = () => clickFocus("prezzoC");
                errorAnchor.onkeyup = event => keyFocus(event,"prezzoC");
                errorDiv.appendChild(errorAnchor);
            }
        }
    }
    if(errorDiv.hasChildNodes()){
        form.prepend(errorDiv);
        errorDiv.focus();
    }
    else{
        form.submit();
    }
}