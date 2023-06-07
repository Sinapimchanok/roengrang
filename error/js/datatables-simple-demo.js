window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
    const allmemtable = document.getElementById('allmemtable');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});
