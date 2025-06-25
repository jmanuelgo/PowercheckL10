import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    let timeout;

    searchInput?.addEventListener('input', function () {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            const query = searchInput.value.trim();

            axios.get('/entrenador/atletas', {
                params: query ? { search: query } : {},
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => {
                document.getElementById('atletas-table').innerHTML = response.data;
            })
            .catch(error => {
                console.error('Error al buscar atletas:', error);
            });
        }, 300);
    });
});
