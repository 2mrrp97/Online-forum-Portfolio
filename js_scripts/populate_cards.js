var cards = [
    {
        header: "Web Development",
        desc: "Visit our forum for Web Development . Feel free to ask questions and post comments and answers as per your wish ! Visit this to connect with our other web developer members!",
        category: "webDev",
        title: "Html5, Css3, JavaScript, Node.js, Php , MySql , MongoDB"

    }
    ,
    {
        header: "Android Development",
        desc: "We code Android Apps in Java! We love Java! We love Application Development. Visit this to connect with our other Android Developer members!",
        category: "androidDev",
        title: "Java"
    }
    ,
    {
        header: "Machine Learning with Python",
        desc: "Machine learning is very important and will become more relvant in the future . Visit this to connect with our other machine learning enthusiast members!",
        category: "ml",
        title: "f(x) = intercept + coeff*x"
    }
];
var cardholder = document.getElementById('cardContainer');
let i = 0;

cards.forEach((obj) => {
    var head = obj.header;
    var desc = obj.desc;
    var category = obj.category;
    var title = obj.title;

    cardholder.innerHTML += `<div class="card border-dark my-2 mx-2 col-lg-3
    col-md-4 col-sm-${i == cards.length - 1 ? 8 : 6} bg-light" >
            <div class="card-header" > <strong>${head}</strong> </div>
            <div class="card-body text-dark">
                <h5 class="card-title">${title}</h5>
                <p class="card-text">${desc}</p>
            </div>
            <div class="card-footer">
                <a href="./threads.php?catid=${category}" class = "btn btn-sm btn-dark" >View Threads </a>
            </div>
        </div> `;
    i++;
    return true;
});

