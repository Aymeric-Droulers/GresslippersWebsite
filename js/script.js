/*
const links = document.querySelectorAll('.page-link');

function loadPage(url) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const html = xhr.responseText;
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newContent = doc.querySelector('#content');
            document.getElementById('content').innerHTML = newContent.innerHTML;
            document.title = doc.title; // Met à jour le titre de la page
        }
    };

    xhr.send();
}

links.forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetPage = this.getAttribute('href');
        loadPage(targetPage);
    });
});
*/