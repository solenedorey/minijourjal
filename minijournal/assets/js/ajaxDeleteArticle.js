var xhrHtml = function (ev) {
    ev.preventDefault();
    var xhr = new XMLHttpRequest();
    var idArticle = ev.target.getAttribute('data-id');
    xhr.open('GET', 'index.php?objet=article&action=supprimer&idArticle=' + idArticle);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.responseType = 'document';
    xhr.onload = function (ev) {
        console.log(idArticle);
        document.querySelector('.liste-articles').removeChild(document.querySelector('.liste-articles li[data-id="' + idArticle + '"]'));
    };
    xhr.send();
};

function init()
{
    clean(document);
    var boutonSuppression = document.querySelectorAll('.bouton-suppression');
    for (var i = 0; i < boutonSuppression.length; i++) {
        boutonSuppression[i].addEventListener('click', xhrHtml);
    }
}

window.addEventListener('load',init);
