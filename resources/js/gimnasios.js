import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    let timeout;

    searchInput?.addEventListener('input', function () {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            const query = searchInput.value.trim();

            axios.get('/admin/gimnasios', {
                params: query ? { search: query } : {},
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => {
                document.getElementById('gym-table').innerHTML = response.data;
            })
            .catch(error => {
                console.error('Error al buscar gimnasios:', error);
            });
        }, 300);
    });
});
