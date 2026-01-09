function updateInventoryCount() {
    console.warn('TODO implement inventory count');
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.URL.match(/inventory\//i)) {
        updateInventoryCount();
    }
});
