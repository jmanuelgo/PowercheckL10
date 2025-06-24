import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-entrenador');
    const tableContainer = document.getElementById('entrenadores-table');

    let timeout;

    searchInput?.addEventListener('input', function () {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            const query = searchInput.value;

            axios.get('/admin/entrenadores', {
                params: { search: query },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(response => {
                tableContainer.innerHTML = response.data;
            })
            .catch(error => {
                console.error('Error al buscar entrenadores:', error);
            });
        }, 300); // Delay para debounce
    });
});
