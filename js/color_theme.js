document.addEventListener("DOMContentLoaded", function() {
    const colorPicker = document.getElementById("colorThemeColor");
    const colorSubmit = document.getElementById("colorThemeSubmit");

    colorPicker.addEventListener("input", function() {
        document.body.style.backgroundColor = colorPicker.value;
    });

    colorSubmit.addEventListener("click", function(event) {
        event.preventDefault();
        document.getElementById("colorTheme").submit();
    });
});
