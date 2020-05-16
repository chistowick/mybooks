"use strict";

// Set an event listener for each element. (selector, event, action)
window.onload = setButtonsAction('.get_random_quotes', 'click', getRandomQuotes);

// Requests and outputs a set of random quotes
function getRandomQuotes() {

    let url = '../components/ajax/get_random_quotes.php';

    // Create a connection
    let request = new XMLHttpRequest();

    // Request setting
    request.open('GET', url);
    request.responseType = 'json';

    // Sending request
    request.send();

    // If connection error
    request.onerror = function () {
        alert(`Ошибка соединения`);
    };
    // When the server response will be received
    request.onload = function () {

        // Analysis of HTTP response status
        if (request.status != 200) {
            // Print error status and error description
            alert(`Ошибка ${request.status}: ${request.statusText}`);

        } else { // if all OK

            // Writing the result to a variable
            let responseObj = request.response;

            // Print the content
            printQuotes(responseObj);

            // Scroll up
            scrollUp(130);
        }
    };

}

// Set an event listener for each element. (selector, event, action)
function setButtonsAction(selector, event, action) {

    let elements = document.querySelectorAll(selector);
    let oneElement;

    // Iterating through elements
    for (let j = 0; j < elements.length; j++) {

        oneElement = elements[j];

        // Setting actions
        oneElement.addEventListener(event, action);

    }
}

// Print the content
function printQuotes(responseObj) {

    // Clear div content
    document.querySelector('#content').innerHTML = ``;

    // Set 'hello'
    let hello = `<h2 id="hello">Лучше, чем цитаты, могут быть только случайно отобранные цитаты.
                            Жмякните на кнопку!</h2>`;

    let addButton = `<button type="button" style="margin-left: auto; 
                margin-right: auto;" class="form_button get_random_quotes">
                Показать пять случайных цитат</button>`;

    // Add 'hello' and a first button
    document.querySelector('#content').insertAdjacentHTML("afterBegin", hello);
    document.querySelector('#hello').insertAdjacentHTML("afterEnd", addButton);

    let text;

    // Iterate the object's properties and insert quotes in HTML
    for (let key in responseObj) {
        text = `<div class="quotes">${responseObj[key].quote}<br>`;
        text += `<p class="source">${responseObj[key].bookname}</p>`;
        text += `<p class="source">${responseObj[key].author}</p></div>`;

        document.querySelector('.form_button').insertAdjacentHTML("afterEnd", text);
    }

    // Add a second button
    document.querySelector('#content').insertAdjacentHTML("beforeEnd", addButton);

    // Set the actions for each buttons
    setButtonsAction('.get_random_quotes', 'click', getRandomQuotes);
}

// Scroll up smoothly
function scrollUp(top) {
    window.scrollTo({
        top: top,
        behavior: "smooth"
    });
}