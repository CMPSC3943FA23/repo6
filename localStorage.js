// LOCAL STORAGE
        function loadItemsFromLocalStorage() {
            if (localStorage.getItem("hobbyItems")) {
                const items = JSON.parse(localStorage.getItem("hobbyItems"));
                    return items;
                }
                    return [];
            }
