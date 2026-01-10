async function updateInventoryCount(url) {
  try 
  {
    const response = await fetch(url);

    if (!response.ok) 
    {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const itemcount = await response.json();

    const listCountSpan = document.getElementById('list-count');

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
    if (document.URL.match(/inventory\//i)) {
        updateInventoryCount('http://127.0.0.1:8000/api/inventory');
    }
});