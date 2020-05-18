"use strict";

// When the whole page has loaded, including styles, pictures and 
// other resources, set the actions on the buttons
window.onload = setButtonsAction('.get_wtr_list', 'click', getWtrList);

// Requests and outputs a 'what-to-read' list
function getWtrList() {

    // Get value of checked radio button
    let idGenre = getCheckedRadioValue();

    // Setting URL and encoding GET-parameters
    let url = new URL('https://mrbooks.ru/components/ajax/get_wtr_list.php');
    url.searchParams.set('id_genre', idGenre);

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

            // Print what-to-read list
            printWtrList(responseObj);

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

// Get value of checked radio button
function getCheckedRadioValue() {
    let radioButtons = document.querySelectorAll('input[name=id_genre]');

    for (let k = 0; k < radioButtons.length; k++) {
        if (radioButtons[k].checked) {
            return radioButtons[k].value;
        }
    }

    return false;
}

// Set link to front page
function setPathToFrontPage() {

    // Find all elements of the class .get_wtr_list
    let pathToFrontPage = document.querySelector('.linkToFrontPage');

    // set actions on click - showFrontPage function
    pathToFrontPage.addEventListener("click", showFrontPage);

}

// Show front page and hide recommendations list
function showFrontPage() {
    // Show div #wtr_select_genre
    let wtrSelectGenre = document.querySelector('#wtr_select_genre');
    wtrSelectGenre.style.display = "block";

    // Clear div #recommendations_list
    clearWtrList();

    scrollUp(130);
}

// Clear and hide div #recommendations_list
function clearWtrList(){
    
    let recommendationsList = document.querySelector('#recommendations_list');
    recommendationsList.innerHTML = ``;
    recommendationsList.style.display = "none";
}

// Scroll up smoothly
function scrollUp(top) {
    window.scrollTo({
        top: top,
        behavior: "smooth"
    });
}

// Print what-to-read list
function printWtrList(responseObj) {

    // Hide div #wtr_select_genre
    let wtrSelectGenre = document.querySelector('#wtr_select_genre');
    wtrSelectGenre.style.display = "none";

    // Show div #recommendations_list
    let recommendationsList = document.querySelector('#recommendations_list');
    recommendationsList.style.display = "block";

    let text = ``;
    let lastAuthor = 'anyone';
    let i = 0;

    // Add greeting
    text += `<h2 id="hello_wtr_result">Рекомендую почитать следующие книги:</h2>`;

    // Add #table_header to text
    text += `<table id='book_table'>
                <tr id='first_row'>
                    <th style='min-width: 150px;'>Название</th>
                    <th style='min-width: 150px;'>Серия</th>
                </tr>`;

    // Get object properties and add them to text
    for (let key in responseObj) {

        if (responseObj[key].author != lastAuthor) {
            text += `<tr>
                        <td class='not_row' colspan='2'></td>
                    </tr>
                    <tr>
                        <th class='author_row' colspan='2'>${responseObj[key].author}</th>
                    </tr>`;
        }

        text += `<tr>
                    <td>${responseObj[key].book_name}</td>
                    <td>${responseObj[key].series || ` `}</td>
                </tr>`;

        lastAuthor = responseObj[key].author;
        i++;
    }

    text += `</table>`;

    // If responseObj is empty - rewrite 'text'
    if (i == 0) {
        text = `<h2>К сожалению, по вашему запросу ничего не найдено.</h2>`;
    }

    // Print 'text'
    recommendationsList.insertAdjacentHTML("beforeEnd", text);

    // Add link and set action for it
    let addLink = `<br><br><button type="button" style="margin-left: auto; 
                            margin-right: auto;" class="form_button linkToFrontPage">
                            Выбрать другой жанр</button>`;
    recommendationsList.insertAdjacentHTML("beforeEnd", addLink);
    
    setPathToFrontPage();
}