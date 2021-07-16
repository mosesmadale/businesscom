//this array will hold all the contacts that will be selected as recipients to the SMS that will be sent.
let selectedContacts = [];
//setting effects for the suggestion box
const fadeIn = element => {
    setTimeout(() => {
        element.style.display = 'flex';
    }, 10)

}

const fadeOut = element => {

    setTimeout(() => {
        element.style.display = 'none';
    }, 10)

}

//this is an arrow function that deletes a selected contact and it is called in the html
const deleteContact = id => {
    //delete from the array
    let modContacts = selectedContacts.filter(contact => {
        return contact['id'] !== id;
    })

    selectedContacts = modContacts;
    document.querySelector('#recipients').value = JSON.stringify(selectedContacts)
        //update the dom with the newly deteled contact out of the array
    document.querySelector('.selected-contacts').innerHTML = '';
    selectedContacts.forEach(contact => {
        document.querySelector('.selected-contacts').innerHTML += `<div class="contact"><span>${contact['name']}</span><div class="remove" onclick="deleteContact(${contact['id']})">Remove</div></div>`
    })
}


//storing a commonly used element in a variable to reduce noise in the code
const searchBar = document.querySelector('#search-bar');

//events to handle the appearance and disappearance of the suggetion bar
searchBar.onfocus = () => {
    fadeIn(document.querySelector('.suggestions'));
}

searchBar.onblur = () => {
    fadeOut(document.querySelector('.suggestions'));
}

//this function allows a user to press the enter key and all the contacts that will be on the suggestion box will be added to the list of recipients
searchBar.onkeypress = e => {
    if (e.key === 'Enter') {
        document.querySelectorAll('.suggestion').forEach(suggestion => {
            let name = suggestion.querySelector('.name').textContent;
            let number = suggestion.querySelector('.number').textContent;
            //push object into selected contacts array
            selectedContacts.push({ name, number, id: selectedContacts.length })
            document.querySelector('#recipients').value = JSON.stringify(selectedContacts)
                //update the dom
            document.querySelector('.selected-contacts').innerHTML = '';
            selectedContacts.forEach(contact => {
                document.querySelector('.selected-contacts').innerHTML += `<div class="contact"><span>${contact['name']}</span><div class="remove" onclick="deleteContact(${contact['id']})">Remove</div></div>`
            })
        })
    }
}


//setting event listeners for the suggestions

document.querySelectorAll('.suggestion').forEach(suggestion => {
    suggestion.addEventListener('mousedown', () => {
        let name = suggestion.querySelector('.name').textContent;
        let number = suggestion.querySelector('.number').textContent;
        //push object into selected contacts array
        selectedContacts.push({ name, number, id: selectedContacts.length })
        document.querySelector('#recipients').value = JSON.stringify(selectedContacts)
            //update the dom
        document.querySelector('.selected-contacts').innerHTML = '';
        selectedContacts.forEach(contact => {
            document.querySelector('.selected-contacts').innerHTML += `<div class="contact"><span>${contact['name']}</span><div class="remove" onclick="deleteContact(${contact['id']})">Remove</div></div>`
        })
    }, false)
})


//grabbing the currently logged in business to inform the php scripts via a get request
const business = document.querySelector('.company-name').textContent;

//fetching contacts from the server

searchBar.oninput = () => {
    let hint = searchBar.value;
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let res = JSON.parse(xhr.responseText);
            let suggestionElement = document.querySelector('.suggestions')
            suggestionElement.innerHTML = '';
            res.forEach(contact => {
                suggestionElement.innerHTML += `<div class="suggestion">
                <div class="name">${contact['name']}</div>
                <div class="number">${contact['number']}</div>
            </div>`
            })
            document.querySelectorAll('.suggestion').forEach(suggestion => {
                suggestion.addEventListener('mousedown', () => {
                    let name = suggestion.querySelector('.name').textContent;
                    let number = suggestion.querySelector('.number').textContent;
                    //push object into selected contacts array
                    selectedContacts.push({ name, number, id: selectedContacts.length })
                    document.querySelector('#recipients').value = JSON.stringify(selectedContacts)
                        //update the dom
                    document.querySelector('.selected-contacts').innerHTML = '';
                    selectedContacts.forEach(contact => {
                        document.querySelector('.selected-contacts').innerHTML += `<div class="contact"><span>${contact['name']}</span><div class="remove" onclick="deleteContact(${contact['id']})">Remove</div></div>`
                    })
                }, false)
            })
        }
    }

    //senging the key search word and the business in which to search contacts from
    xhr.open('GET', `fetch_contacts.php?hint=${hint}&business=${business}`);

    xhr.send();
}