var nav = document.querySelector('#top-nav');
var links = document.querySelectorAll('.nav-link.top-link');
var brand = document.querySelectorAll('.navbar-brand');


var screenWidth = window.innerWidth;

window.addEventListener('resize', () => {
    // console.log(window.innerWidth)
    if(window.innerWidth > 600) {
        navDefault();
    } 
})

const navOnSmallScreen = () => {
    if(window.scrollY > 198 && screenWidth < 600) {
        navWhite();
    }

    document.querySelector('.navbar-toggler').addEventListener('click', (e) => {
        // console.log(e.target.classList)
        var Btn = document.getElementsByClassName('navbar-toggler');

        var classes = Btn[0].classList;
        var arr = new Array();

        for(let i in classes) {
            arr = [...arr, classes[i]];
        }
        // console.log(arr)
        var filter = arr.filter(i => i == "collapsed");
        // console.log(filter)

        if(filter.length > 0) {
            navWhite();
        } else {
            navDefault();
        }

    });
}

navOnSmallScreen();

window.addEventListener('scroll', () => {
    
    if(window.scrollY > 20) {
        
        navWhite();

    } else {
        navDefault();
    }
});

function navWhite() {
    for(let i=0; i<links.length; i++) {
        links[i].classList.add('top-link--primary');
    }
    nav.classList.remove('bg-primary');
    nav.classList.remove('bg-transparent');
    nav.classList.add('bg-white');
    brand[0].classList.add('new-brand-color');
}

function navDefault() {
    nav.classList.remove('bg-white');
    nav.classList.add('bg-primary');
    nav.classList.add('bg-transparent');
        for(let i=0; i<links.length; i++) {
            links[i].classList.remove('top-link--primary');
        }
    brand[0].classList.remove('new-brand-color');
}

function closeAlert() {
    document.querySelector('.alert').style.display = 'none';
}

var staff = JSON.parse(sessionStorage.getItem('_ud'));
if(staff) {
    var fname = staff['fname'];
}

document.getElementById('username').innerHTML = fname;