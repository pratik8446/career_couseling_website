function animateButton() {
    const button = document.querySelector('.explore-btn');
    button.style.transform = 'scale(1.2)';
    setTimeout(() => button.style.transform = 'scale(1)', 300);
}
