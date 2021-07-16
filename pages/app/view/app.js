//using the xhr object to send a request to get all messages that have ever been sent
const xhr = new XMLHttpRequest();

xhr.onreadystatechange = () => {
    if (xhr.status === 200 && xhr.readyState === 4) {
        const messages = JSON.parse(xhr.responseText);
        const messageElement = document.querySelector('.message-list');
        messageElement.innerHTML = '';
        if (messages.length === 0) {
            messageElement.innerHTML = 'You have not sent a message to your customers yet!';
        }
        messages.forEach(message => {
            messageElement.innerHTML += `<div class="message">
            <div class="header">
                <div class="type">
                    <img src="../../assets_global/question_answer_black_24dp.svg" alt="message">
                    <span>Message</span>
                </div>
                <div class="date">${message['date']}</div>
            </div>
            <div class="search-bar">
                ${message['message-data']}
            </div>
        </div>`
        });
        document.querySelector('#search-bar').oninput = () => {
            let hint = document.querySelector('#search-bar').value;
            if (hint.length === 0) {
                messageElement.innerHTML = '';
                if (messages.length === 0) {
                    messageElement.innerHTML = 'You have not sent a message to your customers yet!';
                }
                messages.forEach(message => {
                    messageElement.innerHTML += `<div class="message">
                    <div class="header">
                        <div class="type">
                            <img src="../../assets_global/question_answer_black_24dp.svg" alt="message">
                            <span>Message</span>
                        </div>
                        <div class="date">${message['date']}</div>
                    </div>
                    <div class="search-bar">
                        ${message['message-data']}
                    </div>
                </div>`
                });
            } else {
                let elementsArr = [];
                document.querySelectorAll('.message').forEach(message => {
                    let searchSrc = message.querySelector('.search-bar').textContent;
                    if (searchSrc.includes(hint)) {
                        elementsArr.push(message);
                    }
                })

                const messageElement = document.querySelector('.message-list');
                messageElement.innerHTML = '';
                if (elementsArr.length === 0) {
                    messageElement.innerHTML = 'No matches found!';
                }
                elementsArr.forEach(element => {
                    messageElement.innerHTML += element.outerHTML;
                })
            }

        }
    }
}


//using post to increase security
xhr.open('POST', 'fetch_all_messages.php')

xhr.send();