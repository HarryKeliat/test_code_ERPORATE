$(function() {
	var search = document.querySelector('#search');
	var results = document.querySelector('#browsers');
	var templateContent = document.querySelector('#resultstemplate').content;
	search.addEventListener('keyup', function handler(event) {
	    while (results.children.length) results.removeChild(results.firstChild);
	    var inputVal = new RegExp(search.value.trim(), 'i');
	    var clonedOptions = templateContent.cloneNode(true);
	    var set = Array.prototype.reduce.call(clonedOptions.children, function searchFilter(frag, el) {
	        if (inputVal.test(el.textContent) && frag.children.length < 15) frag.appendChild(el);
	        return frag;
	    }, document.createDocumentFragment());
	    results.appendChild(set);
	});
});
