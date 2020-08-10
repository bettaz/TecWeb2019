window.onload = () => {
    document.getElementById("frmBare").onsubmit = event => {
        event.preventDefault();
        checkInsert(event.target);
    };
};

// TODO da controllare

function checkInsert(form){
    const nome = document.getElementById('nomeB').value;
    const materiale =  document.getElementById('nomeMatB').value;
    const prezzo = document.getElementById('prezzoB').value;
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
        errorAnchor.innerText = "Inserire il nome della bara";
        errorAnchor.onclick = () => clickFocus("nomeB");
        errorAnchor.onkeyup = event => keyFocus(event,"nomeB");
        errorDiv.appendChild(errorAnchor);
    } else {
        if(materiale == ''){
            errorAnchor.innerText = "Inserire il materiale della bara";
            errorAnchor.onclick = () => clickFocus("nomeMatB");
            errorAnchor.onkeyup = event => keyFocus(event,"nomeMatB");
            errorDiv.appendChild(errorAnchor);
        } else {
            if(prezzo == ''){
                errorAnchor.innerText = "Inserire il prezzo della bara";
                errorAnchor.onclick = () => clickFocus("prezzoB");
                errorAnchor.onkeyup = event => keyFocus(event,"prezzoB");
                errorDiv.appendChild(errorAnchor);
            } else {
                if(!expNumb.test(prezzo)){
                    errorAnchor.innerText = "Il prezzo inserito non e' corretto";
                    errorAnchor.onclick = () => clickFocus("prezzoB");
                    errorAnchor.onkeyup = event => keyFocus(event,"prezzoB");
                    errorDiv.appendChild(errorAnchor);
                }
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