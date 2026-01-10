function updateSupplierCount() {
    console.warn('TODO implement supplier count');
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.URL.match(/supplier\//i)) {
        updateSupplierCount();
    }
});

// window.onload = () => //hover on onload for info
// {
//     // const baseurl = window.location.href;
//     //baseurl = window.location.href;

//     if (window.location.href === "http://127.0.0.1:8000/inventory/")
//     {
//         //console.log(window.location.href);
        
//         alert("test");
//     } 

// }
