//function updateInventoryCount() {
    //console.warn('TODO implement inventory count');
    
// Call the function
//fetchData('https://api.example.com/data');


//}

// document.addEventListener('DOMContentLoaded', () => {
//     if (document.URL.match(/inventory\//i)) {
//         updateInventoryCount();
//     }
// });


async function updateInventoryCount(url) {
  try 
  {
    const response = await fetch(url);

    if (!response.ok) 
    {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const itemcount = await response.json();

    //const data = response;
    const listCountSpan = document.getElementById('list-count');

    if (listCountSpan) 
    {
        listCountSpan.textContent = itemcount.length;
    }

    //console.log('Data retrieved:', data.length);

    //return data;

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