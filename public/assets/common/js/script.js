function loader(action = 'block') {
    const loader = document.getElementById('loader');
    if(loader){
        loader.style.display = action;
    }
}

function showLoader()
{
    loader('block');
}

function hideLoader()
{
    loader('none');
}

const forms = document.querySelectorAll('form');
if(!!forms.length){
    forms.forEach(function (el) {
        el.addEventListener("submit", function(e){
            showLoader(1);
        });
    });
}
