const header = document.getElementById("header");

window.addEventListener('scroll', () => {
    const verticalScrollPx = window.scrollY || window.pageYOffset;
  
    if (verticalScrollPx > 10) {
        header.style.backgroundColor = 'White'
        header.style.boxShadow = 'rgba(0, 0, 0, 0.24) 0px 3px 8px'
    } else if (verticalScrollPx < 100) {
        header.style.backgroundColor = '#FFD700'
        header.style.boxShadow = 'none'
    }
  });