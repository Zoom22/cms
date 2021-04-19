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

$(function(){
    $("#form").on("submit", function(e){
        e.preventDefault();
        const about = document.querySelector('#about');
        const textarea = document.querySelector('#textarea');

        if (!textarea.hidden) {

            var formData = $(this).serializeArray();
            about.innerHTML = formData[1].value;
            $.ajax({
                url: "/profile/edit",
                type: "POST",
                data: formData,
                cache: false,
            });
        }
        toggleHidden(about, textarea);
    });
});

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

document.getElementById('avatar').addEventListener('change', function(e) {
    e.preventDefault();
    const avatarForm = document.querySelector('#photo');
    avatarForm.submit();
});
