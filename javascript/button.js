const button = document.getElementById("copy-button");

button.onclick = () => {
    navigator.clipboard.writeText(window.location.href);
}
