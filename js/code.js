function showProducts(product_id) {
	xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("main").innerHTML = this.responseText;
		}
	};

	xmlhttp.open("GET", "api/products.php", true);
	xmlhttp.send();
}

function generateCode(product_id) {
	xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("code").value = this.responseText;
		}
	};

	xmlhttp.open("GET", "generatecode.php?product_id=" + product_id, true);
	xmlhttp.send();
}