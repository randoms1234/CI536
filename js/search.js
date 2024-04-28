window.addEventListener("load", function(){
    const form = document.querySelector('#searchform');
    form.addEventListener('submit', sendSearch);
});

async function sendSearch(evt){
    evt.preventDefault();

    const search = document.querySelector('#search').value.trim();
    document.querySelector('#srchresult').style.display = 'grid';
    document.querySelector('#usrsearch').textContent = "You Searched For: " + search;
}