var xhrHtml = function (ev) {
    var xhr = new XMLHttpRequest();
    var idArticle = ev.target.getAttribute('data-id');
    xhr.open('GET', 'index.php?objet=article&action=inverseStatutPublication&idArticle=' + idArticle);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.responseType = 'document';
    xhr.onload = function (ev) {
        document.querySelector('#bouton-publication').innerHTML = ev.target.response.querySelector('#bouton-publication').innerHTML;
        if (ev.target.response.querySelector('.date-publication') !== null) {
            document.querySelector('.date').appendChild(ev.target.response.querySelector('.date-publication'));
        } else {
            document.querySelector('.date').removeChild(document.querySelector('.date-publication'));
        }
    };
    xhr.send();
};

function init()
{
    clean(document);
    var onOffSwitch = document.querySelector('#bouton-publication');
    onOffSwitch.addEventListener('click', xhrHtml);
}

window.addEventListener('load',init);