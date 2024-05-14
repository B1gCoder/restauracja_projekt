document.getElementById('toggle-showForm').addEventListener('click', function() {
    var form = document.getElementById('dodawaniePotrawyForm');
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
});