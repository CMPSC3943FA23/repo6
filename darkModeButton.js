// LIGHT/DARK MODE BUTTON
        <script>
        document.querySelector("#toggleMode").addEventListener("click", function() {
            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        });
        </script>
