import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');

    let timeout;
    searchInput?.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            const query = searchInput.value;
            axios.get('/admin/gimnasios', { params: { search: query } })
                .then(response => {
                    document.getElementById('gym-table').innerHTML = response.data;
                })
                .catch(error => {
                    console.error('Error al buscar gimnasios:', error);
                });
        }, 300); // debounce
    });
});
