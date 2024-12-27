let smmEnabled = true;
let paymentEnabled = true;
let scraperEnabled = true;
let aiEnabled = true;

getRequest(
    `/website/user_services`,

    function (response) {

        if (response.data.data.ai == null){
            document.getElementById('ai-text').textContent = 'Buy';
            aiEnabled = false;
        }else{
            document.getElementById('ai-text').textContent = 'See details';
        }

        if (response.data.data.smm == null){
            document.getElementById('ssm-text').textContent = 'Buy';
            smmEnabled = false;
        }else{
            document.getElementById('ssm-text').textContent = "See details";
        }

        if (response.data.data.payment == null){
            document.getElementById('payment-text').textContent = 'Buy';
            paymentEnabled = false;
        }else{
            document.getElementById('payment-text').textContent = 'See details';
        }

        if (response.data.data.scraper == null){
            document.getElementById('scraper-text').textContent = 'Buy';
            scraperEnabled = false;
        }else{
            document.getElementById('scraper-text').textContent = 'See details';
        }

    },
    function (error) {
        redirectToLoginIfUnauthorized(error);
    }
);

document.getElementById('ssm').addEventListener('click', function(event) {
    if (!smmEnabled) {
        event.preventDefault();
        window.location.href = "/package";
    }else {
        window.location.href = "/social-media-marketing";
    }

});

document.getElementById('payment').addEventListener('click', function(event) {
    if (!paymentEnabled) {
        event.preventDefault();
        window.location.href = "/package";
    }else {
        window.location.href = "/payment";
    }

});

document.getElementById('scraper').addEventListener('click', function(event) {
    if (!scraperEnabled) {
        event.preventDefault();
        window.location.href = "/package";
    }else {
        window.location.href = "/scraper";
    }

});

document.getElementById('ai').addEventListener('click', function(event) {
    if (!aiEnabled) {
        event.preventDefault();
        window.location.href = "/package";
    }else {
        window.location.href = "/ai";
    }

});

