window.onload = () => {
    document.getElementById("frmUrne").onsubmit = event => {
        event.preventDefault();
        checkInsert(event.target);
    };
};

// TODO da controllare

function checkInsert(form){
    const nome = document.getElementById('nomeU').value;
    const materiale =  document.getElementById('nomeMatU').value;
    const prezzo = document.getElementById('prezzoU').value;
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
        errorAnchor.innerText = "Inserire il nome del'urna";
        errorAnchor.onclick = () => clickFocus("nomeU");
        errorAnchor.onkeyup = event => keyFocus(event,"nomeU");
        errorDiv.appendChild(errorAnchor);
    } else {
        if(materiale == ''){
            errorAnchor.innerText = "Inserire il materiale del'urna";
            errorAnchor.onclick = () => clickFocus("nomeMatU");
            errorAnchor.onkeyup = event => keyFocus(event,"nomeMatU");
            errorDiv.appendChild(errorAnchor);
        } else {
            if(prezzo == ''){
                errorAnchor.innerText = "Inserire il prezzo del'urna";
                errorAnchor.onclick = () => clickFocus("prezzoU");
                errorAnchor.onkeyup = event => keyFocus(event,"prezzoU");
                errorDiv.appendChild(errorAnchor);
            } else {
                if(!expNumb.test(prezzo)){
                    errorAnchor.innerText = "Il prezzo inserito non e' corretto";
                    errorAnchor.onclick = () => clickFocus("prezzoU");
                    errorAnchor.onkeyup = event => keyFocus(event,"prezzoU");
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