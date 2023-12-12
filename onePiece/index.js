var loginButton = document.getElementById('loginButton');
var document = document.getElementById('loginPopup');
var loginPopup = document.getElementById('loginPopup');
function showLoginPopup() {
    console.log("showLoginPopup");
    loginPopup.style.display = 'block';
    document.addEventListener('click', closePopupOnClickOutside);

}

function closePopupOnClickOutside(event) {
    if (!loginPopup.contains(event.target) && event.target !== document.getElementById('loginli')) {
        console.log(event.target);
        loginPopup.style.display = 'none';
        document.removeEventListener('click', closePopupOnClickOutside);
    }  

}
loginButton.addEventListener('click', showLoginPopup);