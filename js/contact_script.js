let accountBox = document.querySelector('.header .user-box');

document.querySelector('#user-btn').onclick = () => {
    accountBox.classList.toggle('active');
}

window.onscroll = () => {
    accountBox.classList.remove('active');
}

let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
};

window.onscroll = () => {
    searchForm.classList.remove('active');
};

window.onload = () => {
    const header2 = document.querySelector('.header .header-2');
    header2.classList.add('non-active');
    document.querySelector('.bottom-navbar').classList.add('non-active');
    fadeOut();
};

function loader() {
    document.querySelector('.loader-container').classList.add('active');
}

function fadeOut() {
    setTimeout(loader, 2000);
}