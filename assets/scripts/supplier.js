async function updateSupplierCount(url) {
  try 
  {
    const response = await fetch(url);

    if (!response.ok) 
    {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const itemcount = await response.json();

    const listCountSpan = document.getElementById('supplier-count');

    if (listCountSpan) 
    {
        listCountSpan.textContent = itemcount.length;
    }

  } 
  catch (error) 
  {
    console.error('Error fetching data:', error);
  }
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.URL.match(/supplier\//i)) {
        updateSupplierCount('http://127.0.0.1:8000/api/suppliers');
    }
});
