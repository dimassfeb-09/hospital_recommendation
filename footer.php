<script>
    function showAdminPopup() {
        var popup = document.getElementById('adminPopup');
        popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
    }

    document.getElementById('adminLink').addEventListener('click', function(event) {
        event.preventDefault();
        showAdminPopup();
    });
</script>
</body>

</html>