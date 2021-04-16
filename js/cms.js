'use strict';

const toggleHidden = (...fields) => {

    fields.forEach((field) => {

        if (field.hidden === true) {

            field.hidden = false;

        } else {

            field.hidden = true;

        }
    });
};

const editButton = document.querySelector('#edit');
if (editButton) {
    editButton.addEventListener('click', evt => {
        const about = document.querySelectorAll('#about');
        const textarea = document.querySelectorAll('#textarea');
        about.hidden = true;
        textarea.hidden = false;
    });
};