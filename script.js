const header = document.getElementById("header");
const sidebar = document.getElementById("sidebar");
const main = document.getElementById("crt");
const close = document.getElementById("menu-Close");

//window event to change background color of the header
window.addEventListener('scroll', () => {
    const verticalScrollPx = window.scrollY || window.pageYOffset;
  
    if (verticalScrollPx > 10) {
        header.style.backgroundColor = 'White'
        header.style.boxShadow = 'rgba(0, 0, 0, 0.24) 0px 3px 8px'
    } else if (verticalScrollPx < 100) {
        header.style.backgroundColor = '#ffd22f'
        header.style.boxShadow = 'none'
    }
  });

function toggleSidebar() {
    sidebar.style.display = "flex";
    header.style.display = "none";
}

function toggleClose() {
    sidebar.style.display = "none";
    header.style.display = "flex";
}

  

