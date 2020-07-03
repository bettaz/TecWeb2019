function clickFocus(tagName) {
    document.getElementById(tagName).focus();
}
function keyFocus(keyEvent, tagName) {
    if(keyEvent.key == "Enter"){
        keyEvent.preventDefault();
        clickFocus(tagName);
    }
}