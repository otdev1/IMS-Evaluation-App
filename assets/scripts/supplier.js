function updateSupplierCount() {
    console.warn('TODO implement supplier count');
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.URL.match(/supplier\//i)) {
        updateSupplierCount();
    }
});
