"use strict";

// When the whole page has loaded, including styles, pictures and 
// other resources, set the actions on the buttons
let feedbackButton = document.querySelector('#feedback_button');
window.onload = feedbackButton.addEventListener("click", sendFeedbackForm);

// Sends the reCAPTCHA token and feedback form data to the handler
function sendFeedbackForm() {

    let subj = document.querySelector('#subj').value;
    let textArea = document.querySelector('#textArea').value;
    let token = grecaptcha.getResponse();

    // Checking the token and form fields
    let ready = readinessCheck(subj, textArea, token);

    // If something is wrong - interrupt
    if (ready === false) {
        return;
    }

    let url = '../components/ajax/send_feedback_email.php';

    // Create POST request data
    let postData = new FormData();
    postData.append('subj', subj);
    postData.append('textArea', textArea);
    postData.append('token', token);

    // Create a connection
    let request = new XMLHttpRequest();

    // Request setting
    request.open('POST', url);
    request.responseType = 'text';

    // Sending request
    request.send(postData);

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

            if (request.response == 'true') {
                alert('Ваше сообщение успешно отправлено');
            } else {
                alert('Сообщение не отправлено. Попробуйте еще раз');
            }
            // Clear the form fields
            clearFormFields();
        }
    }

}

// Checking the token and form fields
function readinessCheck(subj, textArea, token) {

    if (subj && textArea && token) {
        return true;
    }

    if (!(subj) || !(textArea)) {
        alert('Заполните все поля формы');
        return false;
    }

    if (!token) {
        alert('Подтвердите, что Вы не робот');
        return false;
    }

    return false;
}

// Clear the form fields
function clearFormFields() {
    document.querySelector('#subj').value = '';
    document.querySelector('#textArea').value = '';
}