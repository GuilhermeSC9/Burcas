window.addEventListener('scroll', function() {
    var header = document.getElementById('header');
    if (window.pageYOffset === 0) {
        header.classList.remove('scrolled');
    } else {
        header.classList.add('scrolled');
    }
});