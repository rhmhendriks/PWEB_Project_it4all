const Slide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.links');
    const links = document.querySelectorAll('.liFade');



    burger.addEventListener('click', () => {
       //Toggle nav(die slide)
        nav.classList.toggle('nav-active');

        //Animation of the links
        links.forEach((link, index) => {
            if (link.style.animation) {
                link.style.animation = '';
            } else {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.5}s`;
            }
        });
        //Burger animation
        burger.classList.toggle('toggleBurger');

    });

}

Slide(); 