import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    const notification = document.getElementById('notification');

    // Montre la notification avec animation slide-in
    notification.classList.add('slide-in');

    // Après 4 secondes, commence l'animation de sortie
    setTimeout(() => {
        notification.classList.remove('slide-in');
        notification.classList.add('slide-out');
    }, 4000);

    // Après 4,5 secondes, retire la notification du DOM
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 4500);
});

document.querySelectorAll('.delete-item').forEach(function(element) {
    element.addEventListener('click', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément?')) {
            e.preventDefault();
        }
    });
});


document.getElementById('submitButtonCC').addEventListener('click', function() {
    document.getElementById('myCCForm').action ="/notes/CC/update";
    document.getElementById('myCCForm').submit();
});

document.getElementById('submitButtonSN').addEventListener('click', function() {
    document.getElementById('mySNForm').action ="/notes/SN/update";
    document.getElementById('mySNForm').submit();
});
