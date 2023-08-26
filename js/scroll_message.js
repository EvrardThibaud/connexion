// Récupérer la boîte de messages
var messageBox = document.getElementById('messageBox');

// Régler la position de défilement au bas par défaut
messageBox.scrollTop = messageBox.scrollHeight;
messageBox.classList.add('scrollToBottom');