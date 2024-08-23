import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('click', (event) => {
    if (!event.target.closest('.relative')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (!menu.classList.contains('hidden')) {
                menu.classList.remove('dropdown-enter-active');
                menu.classList.add('dropdown-leave');
                setTimeout(() => {
                    menu.classList.remove('dropdown-leave');
                    menu.classList.add('hidden');
                }, 75);
            }
        });
    }
});

document.querySelectorAll('.dropdown-button').forEach(button => {
    button.addEventListener('click', () => {
        const menu = button.nextElementSibling;

        // Check if menu exists
        if (menu && menu.classList.contains('dropdown-menu')) {
            const isHidden = menu.classList.contains('hidden');

            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                if (otherMenu !== menu) {
                    otherMenu.classList.remove('dropdown-enter-active');
                    otherMenu.classList.add('dropdown-leave');
                    setTimeout(() => {
                        otherMenu.classList.remove('dropdown-leave');
                        otherMenu.classList.add('hidden');
                    }, 75);
                }
            });

            if (isHidden) {
                menu.classList.remove('hidden');
                menu.classList.add('dropdown-enter');
                requestAnimationFrame(() => {
                    menu.classList.remove('dropdown-enter');
                    menu.classList.add('dropdown-enter-active');
                });
            } else {
                menu.classList.remove('dropdown-enter-active');
                menu.classList.add('dropdown-leave');
                setTimeout(() => {
                    menu.classList.remove('dropdown-leave');
                    menu.classList.add('hidden');
                }, 75);
            }
        }
    });
});

document.getElementById('close-modal').addEventListener('click', () => {
    document.getElementById('edit-modal').classList.add('hidden');
});

document.getElementById('close-delete-modal').addEventListener('click', () => {
    document.getElementById('delete-modal').classList.add('hidden');
});

document.getElementById('cancel-delete').addEventListener('click', () => {
    document.getElementById('delete-modal').classList.add('hidden');
});

document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', () => {
        const leadId = button.closest('tr').dataset.leadId;
        const modal = document.getElementById('delete-modal');
        const confirmButton = document.getElementById('confirm-delete');
        const cancelButton = document.getElementById('cancel-delete');

        confirmButton.dataset.leadId = leadId;

        modal.classList.remove('hidden');
    });
});
