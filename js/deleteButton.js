// DELETE BUTTON
        document.querySelector("#itemsContainer").addEventListener("click", function(e) {
            if (e.target.classList.contains('deleteItemBtn')) {
                const card = e.target.closest('.card');
                const itemId = card.getAttribute('data-id');

                deleteItemFromLocalStorage(itemId);
                card.remove();
            }
        });
