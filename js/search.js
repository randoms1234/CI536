window.addEventListener("load", function(){
    const form = document.querySelector('#searchform form');
    form.addEventListener('submit', sendSearch);
});

async function sendSearch(evt){
    evt.preventDefault();

    const search = document.querySelector('#search').value.trim();
    if (search === '') return;

    try {
        const response = await fetch(`index.php?search=${encodeURIComponent(search)}`);
        const text = await response.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(text, 'text/html');
        const results = doc.querySelector('#srchresult');

        if (results) {
            document.querySelector('#srchresult').innerHTML = results.innerHTML;
            document.querySelector('#srchresult').style.display = 'grid';
            document.querySelector('#usrsearch').textContent = "You Searched For: " + search;
        } else {
            console.error('Search results element not found in response.');
        }
    } catch (error) {
        console.error('Error fetching search results:', error);
    }
}
