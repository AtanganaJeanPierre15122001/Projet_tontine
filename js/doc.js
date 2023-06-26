function showImage() {
    const input = document.getElementById('image');
    const img = document.getElementById('imageAffichee');
    const file = input.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        img.src = e.target.result;
    };

    reader.readAsDataURL(file);
}


var loader = document.querySelector(".loader");

	    window.addEventListener("beforeunload", function() {
	        loader.style.display = "flex";
	    });

        window.addEventListener("load", function() {
	        setTimeout(function() {
	          loader.style.display = "none";
	        }, 2000); // 2000 pour 2 secondes, modifiez cette valeur selon vos besoins
	    });