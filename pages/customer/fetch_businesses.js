//fetching all the registered businesses from the server and adding them as options to a select element in the DOM
const xhr = new XMLHttpRequest();

xhr.onreadystatechange = () => {
    if (xhr.status === 200 && xhr.readyState === 4) {
        const businesses = JSON.parse(xhr.responseText);
        const selectElement = document.querySelector('#businesses-selects');
        selectElement.innerHTML = '';
        businesses.forEach(business => {
            selectElement.innerHTML += `<option value="${business}">${business}</option>`
        });
    }
}

xhr.open('POST', 'fetch_businesses.php')

xhr.send();