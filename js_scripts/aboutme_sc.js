
// this fnc for typing text effect 
var msgElt = document.getElementById('writing_textEffect');
let mssg = "Welcome! Here I have show cased all of my Projects and technologies i have worked on !";

function write(msg, element, index) {
    let s = new String();

    let interval = setInterval(() => {
        s = s.concat(msg.charAt(index++));
        element.innerText = s;
        if (index == msg.length) {
            clearInterval(interval);
            return;
        }
    }, 70);
}

write(mssg, msgElt, 0);

let i = 0;
let arr = [" Subhro Sen ", "a Full Stack webDev", "a ML Enthusiast", "a Programmer"];
var whatami = document.getElementById('whatami');
setInterval(() => {
    whatami.innerText = arr[i];
    i = (i + 1) % arr.length;
}, (1000));


var abtme = document.getElementById('smthab');
var pgbars = document.querySelectorAll('.progress-bar');

// this fnc for appear effect
function appear_if_inview(element) {
    let distance_to_top = element.getBoundingClientRect().top;
    let scrht = window.innerHeight;

    if (distance_to_top < scrht) {
        element.classList.add("appear-in");
    }
    else
        element.classList.remove("appear-in");
}


// this fnc for appear effect elemnt comes from l to r 
function appear_if_inview_lr(element) {
    let distance_to_top = element.getBoundingClientRect().top;
    let scrht = window.innerHeight;

    if (distance_to_top < scrht) {
        element.classList.add("appear-in-lr");
    }
    else
        element.classList.remove("appear-in-lr");
}

// next part is for animating prg bars 
let vals = {
    "communication": 80,
    "newTech": 85,
    "coding": 95,
    "team": 90,
    "htmlbar": 80,
    "cssbar": 75,
    "jsbar": 70,
    "bootstrapbar": 70,
    "reactbar": 60,
    "phpbar": 75,
    "mysqlbar": 90,
    "nodebar": 80,
    "mongobar": 70,
    "apachebar": 80,
    "gitbar": 50,
    "jquery": 60
};

// fnc to animate prg bars 
function animate_bars(elementList) {
    elementList.forEach(element => {
        let distance_to_top = element.getBoundingClientRect().top;
        let scrht = window.innerHeight;
        let id = element.id;

        if (distance_to_top < scrht) {
            element.style.width = `${vals[id]}%`;
        }
        else
            element.style.width = `${0}%`;
    });
}

// run the functions every time client scrolls 
window.addEventListener('scroll', () => {
    appear_if_inview(abtme);
    appear_if_inview(bars);
    animate_bars(pgbars);
});

// run the functions and check for  every time page loads 
window.addEventListener('load', () => {
    console.log('yay');
    appear_if_inview(abtme);
    appear_if_inview(bars);
    animate_bars(pgbars);
    filter_and_show(projects, 'frontend');
});



// next part for project selection part 

var btns = document.querySelectorAll('.myBtn');

btns.forEach((element) => {
    element.addEventListener('click', () => {
        btns.forEach((elt) => {
            elt.classList.remove('btn-active');
        });
        element.classList.add('btn-active');
        filter_and_show(projects, element.dataset.id);
    });
});


const projects = [
    {
        "link": "https://2mrrp97.github.io/weatherApp/",
        "title": "Weather forecast App",
        "type": "frontend",
        "techused": "HTML , CSS , Javascript , Bootstrap , OpenWeather API",
        "desc": "A web App which take a city name as input and display the current weather and forecast of the next 15 hours at an interval of 3 hours of that city , dynamically by fetching results from a free weather Api . this can be easily modified to change the forecast into bigger intervals and styling can be changed accordingly. "
    }
    ,
    {
        "link": "https://2mrrp97.github.io/e-commerce/",
        "title": "E-commerce website",
        "type": "frontend",
        "techused": "HTML , CSS , JavaScript , Bootstrap , jquery",
        "desc": "This is a complete responsive front-page for an E-commerce website along with some other parts ,  who sells electronic items . This template is divided into modules and can be modified when needed to fit the requirement  "
    }
    ,
    {
        "link": "https://2mrrp97.github.io/travel-agency/",
        "title": "Travel Agency landing page",
        "type": "frontend",
        "techused": "HTML , CSS , JavaScript , Bootstrap , jquery",
        "desc": "This is a complete responsive front-page for a Travel agency who provides consultancy and other services to customer regarding their vacations . This template is divided into modules and can be modified when needed to fit the requirement "
    }
    ,
    {
        "link": "https://2mrrp97.github.io/portfolio/",
        "title": "portfolio practice",
        "type": "frontend",
        "techused": "HTML , CSS , JavaScript , Bootstrap",
        "desc": "A demo portfolio page i made for myself , while learning new technologies just for fun"
    }
    ,
    {
        "link": "https://2mrrp97.github.io/login_signup_form/",
        "title": "login signup form validation",
        "type": "frontend",
        "techused": "HTML , CSS , JavaScript",
        "desc": "a form for login and signup with form validation using javascript , form method post needs to be added This project is an early demonstartion of my javaScript expertise"
    }
    ,
    {
        "link": "https://2mrrp97.github.io/Js-color-flipper/",
        "title": "Random RGB Color generator",
        "type": "frontend",
        "techused": "HTML , CSS , JavaScript",
        "desc": "This project generates a random rgb colour and changes the background every time change is event is triggered . This project is an early demonstartion of my javaScript expertise"
    }
    ,
    {
        "link": "https://2mrrp97.github.io/Carousel-Project/",
        "title": "Custom Carousel Slider",
        "type": "frontend",
        "techused": "HTML , CSS , JavaScript",
        "desc": "This project tries to mimic the effect of circular slider, This changes the current slider every time change is event is triggered . This project is an early demonstartion of my javaScript expertise"
    }
    ,
    {
        "link": "#",
        "title": "Employee records App",
        "type": "fullstack",
        "techused": "HTML , CSS , JavaScript , Php , MySQL , Apache server",
        "desc": "A full stack app that can be used as an online employee record tracking app by any company , in their database with edit and delete functionality"
    }
    ,
    {
        "link": "#",
        "title": "Final Portfolio + online tech forum",
        "type": "fullstack",
        "techused": "HTML , CSS , JavaScript , Php , MySQL , Apache server",
        "desc": "A full working live portfolio + online tech forum with login , signup , thread search , commenting , creating new threads and many more functionalities developed using html , css , bootstrap , javascript , php and MYSQL and love."
    }
];


var projectcards = document.getElementById('projectcards');
function filter_and_show(arr, type) {

    var s = "";
    arr.filter((obj) => {
        return obj['type'] == type;
    }).forEach((element) => {
        s += `<div class="mycard my-2  col-md-10 col-sm-10 col-lg-3" data-id="small" style = "position : relative ;">
                <div class="card-header" >
                    <h3>
                        <a href="${element['link']}" target="_blank" style = "color : black;"> ${element['title']}
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <h5>Technologies used : ${element['techused']}</h5>
                    <h6 class = "my-3"><strong><i>Description :</i></strong> ${element['desc']}</h6>
                        <a href="${element['link']}" target = "_blank" class="btn btn-md btn-dark mt-2" style = "position : absolute ; left : 20px ; bottom : 20px ;">View Project</a>
                </div>
               </div>`;

    });
    projectcards.innerHTML = s;
    if (projectcards.children.length == 0) {
        projectcards.innerHTML = '<div class = "fw-bold"><h3>Sorry , no projects are uploaded in this category yet. </h3></div>';
    }
}