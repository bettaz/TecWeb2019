window.onload = () => {
    document.getElementById("frmFiori").onsubmit = event => {
        event.preventDefault();
        checkInsert(event.target);
    };
};

// TODO da controllare

function checkInsert(form){
    const nome = document.getElementById('nomeF').value;
    const prezzo = document.getElementById('prezzoF').value;
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
    if(nome == ''){
        errorAnchor.innerText = "Inserire il nome della composizione";
        errorAnchor.onclick = () => clickFocus("nomeF");
        errorAnchor.onkeyup = event => keyFocus(event,"nomeF");
        errorDiv.appendChild(errorAnchor);
    } else {
        if(prezzo == ''){
            errorAnchor.innerText = "Inserire il prezzo della composizione";
            errorAnchor.onclick = () => clickFocus("prezzoF");
            errorAnchor.onkeyup = event => keyFocus(event,"prezzoF");
            errorDiv.appendChild(errorAnchor);
        } else {
            if(!expNumb.test(prezzo)){
                errorAnchor.innerText = "Il prezzo inserito non e' corretto";
                errorAnchor.onclick = () => clickFocus("prezzoF");
                errorAnchor.onkeyup = event => keyFocus(event,"prezzoF");
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