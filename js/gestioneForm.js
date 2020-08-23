window.onload = () => {
    document.getElementById("frmDeletion").onsubmit = event => {
        event.preventDefault();
        checkRemove(event.target);
    };
};
function checkRemove(form){
    const product = document.getElementById('nomeRemoveP').value;
    console.log(product);
    if(product=== '---'){
        let errorDiv = document.getElementById("errors");
        if(errorDiv)
            document.getElementById("errors").remove();
        errorDiv = document.createElement("div");
        errorDiv.id = "errors";
        errorDiv.className = "linea";
        errorDiv.tabIndex = -1;
        let errorAnchor = document.createElement("a");
        errorAnchor.tabIndex = 0;
        errorAnchor.innerText = "Selezionare un prodotto da rimuovere";
        errorAnchor.onclick = () => clickFocus("nomeU");
        errorAnchor.onkeyup = event => keyFocus(event,"nomeRemoveP");
        errorDiv.appendChild(errorAnchor);
        document.getElementById("frmDeletion").insertBefore(errorDiv, document.getElementById("removeField"));
        errorDiv.focus();
    } else {
        form.submit();
    }
}
