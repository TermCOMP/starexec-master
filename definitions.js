var get_args = {};
if( 1 < window.location.search.length ) {
	var pairs = window.location.search.substring(1).split('&');
	for( var i in pairs ) {
		var ler = pairs[i];
		var e = ler.indexOf('=');
		var key = decodeURIComponent(ler.substring(0,e));
		var val = decodeURIComponent(ler.substr(e+1));
		get_args[key] = val;
	}
}
function loadURL(url,handle) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      handle(this);
    }
  };
  xhttp.open("GET", url);
  xhttp.send();
}
function FilteredTable(table) {
	var ret = {};
	ret.table = table;
	ret.filters = [];
	ret.refresh = function () {
		var filterValues = [];
		for( var j = 0; j < ret.filters.length; j++ ) {
			var id = ret.filters[j];
			filterValues[j] = id == null ? "" : document.getElementById(id).value;
		}
		var trs = ret.table.getElementsByTagName("tr");
		for( var i = 0; i < trs.length; i++ ) {
			if( trs[i].classList.contains("head") ) {// row of class "head" won't be filtered
				continue;
			}
			var tds = trs[i].getElementsByTagName("td");
			for( var j = 0; ; j++ ) {
				if( filterValues.length <= j ) {
					trs[i].style.display = "";
					break;
				}
				var td = tds[j];
				if( td != null && (td.textContent || td.innerText).indexOf(filterValues[j]) < 0 ) {
					trs[i].style.display = "none";
					break;
				}
			}
		}
	}
	ret.register = function(column,id) {
		ret.filters[column] = id;
	}
	return ret;
}
function StyleToggler(button, select, options) {
	var ret = {};
	ret.button = button;
	ret.select = select;
	ret.options = options;
	ret.index = 0;
	ret.apply = function(elm) {
		var option = ret.options[ret.index];
		ret.button.innerHTML = option.text;
		var targets = elm.querySelectorAll(select);
		for( var i = 0; i < targets.length; i++ ) {
			for( var key in option.assign ) {
				targets[i].style[key] = option.assign[key];
			}
		}
	}
	ret.toggle = function() {
		ret.index = (ret.index + 1) % ret.options.length;
		ret.apply(document);
	}
	ret.apply(document);
	ret.button.onclick = ret.toggle;
	return ret;
}
