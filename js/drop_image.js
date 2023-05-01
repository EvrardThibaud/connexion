const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('profilePictureFile');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false)
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false)
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false)
});

function highlight(e) {
    dropArea.classList.add('highlight');
}

function unhighlight(e) {
    dropArea.classList.remove('highlight');
}

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    let dt = e.dataTransfer;
    let files = dt.files;

    handleFiles(files);
}

function handleFiles(files) {
    if (files.length === 1 && files[0].type.startsWith('image/')) {
        fileInput.files = files;
    } else {
        alert("Veuillez sélectionner une image.");
    }
}
