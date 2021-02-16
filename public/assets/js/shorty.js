document.addEventListener("DOMContentLoaded", function (event) {

    var clipboard = new ClipboardJS('#shortUrlCopiedToastBtn');
    var toast = new bootstrap.Toast(document.getElementById('shortUrlCopiedToast'));
    let element = document.getElementsByName('new-link').item(0);
    let notification = document.getElementsByClassName('short-url-display').item(0);
    let notificationRow = document.getElementsByClassName('short-alert-row').item(0);
    if (typeof element !== "undefined") {
        element.addEventListener('submit', function (event) {
            event.preventDefault();
            axios.post(
                '/new',
                {
                    "target": element.querySelector('input[name=long]').value
                }
            ).then(function (response) {
                notificationRow.getElementsByClassName('short-link-box').item(0).innerText = response.data.short;
                notificationRow.classList.remove("d-none");
            }).catch(function (error) {
                console.log(error);
            });
        });
    }

    document.getElementById('shortUrlCopiedToastBtn').addEventListener('click', function (event) {
        toast.show();
    });
});