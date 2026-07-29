const pwdmodal = document.getElementById("pwdmodal");
const main = document.getElementById("maincont");
const changepwd = document.getElementById("chngpwd");
const cancel = document.getElementById("closeModal");

changepwd.onclick = function () {
    main.style.display = "none";
    pwdmodal.style.display = "flex";
};

cancel.onclick = function () {
    pwdmodal.style.display = "none";
    main.style.display = "block";
};