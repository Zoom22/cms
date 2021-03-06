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

$(function () {
    $("#form").on("submit", function (e) {
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
const avatar = document.getElementById('avatar');
if (avatar) {
    avatar.addEventListener('change', function (e) {
        e.preventDefault();
        const avatarForm = document.querySelector('#photo');
        avatarForm.submit();
    });
}
const count = document.getElementById("count");
if (count) {
    count.addEventListener('change', function () {
        document.getElementById("select").submit();
    });
}

$(function () {
    $("#subscribe").on("submit", function (e) {
        e.preventDefault();
        const error = document.querySelector('#error');
        const success = document.querySelector('#success');
        var formData = $(this).serializeArray();
        $.ajax({
            url: "/",
            type: "POST",
            data: formData,
            cache: false,
            success: function (data) {
                if (data) {
                    error.innerHTML = data;
                    error.hidden = false;
                    success.hidden = true;
                } else {
                    success.hidden = false;
                    error.hidden = true;
                }
            }
        });
    });
});

$(function () {
    $(".group").on("change", function (e) {
        e.preventDefault();
        var id = $(this).attr('data-user_id');
        var group = $(this).val();
        $.ajax({
            url: "/users/change",
            type: "POST",
            data: {'id': id, 'group': group},
            cache: false,
            success: function (data) {
                console.log(data);
                if (data) {
                    document.getElementById('notification').innerHTML = data;
                    $('.toast').toast('show');
                }
            }
        });
    });
});
