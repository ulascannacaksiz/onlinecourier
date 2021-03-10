<script>
	$(() => {
		//$('.select2').select2();

		let isClicked = "";
		$("#carbtn").click(function () {
			if (isClicked == "" || isClicked != "car") {
				if($("#weight").children().length > 0){
					$("#weight").empty();
				}
				let weights = [20, 50, 100, 200];
				for (let i = 0; i < 4; i++) {
					let button = document.createElement("button");
					button.className = "btn btn-outline-success mx-2";
					button.setAttribute("value",weights[i]);
					button.innerText = weights[i] + " kg kadar";
					$("#weight").append(button);
				}
				isClicked = "car";
			}
		});
		$("#motorbtn").click(function () {
			if (isClicked == "" || isClicked != "motor") {
				if ($("#weight").children().length > 0) {
					$("#weight").empty();
				}
				let weights = [2, 5, 10, 15];
				for (let i = 0; i < 4; i++) {
					let button = document.createElement("button");
					button.className = "btn btn-outline-success mx-2";
					button.setAttribute("value",weights[i]);
					button.innerText = weights[i] + " kg kadar";
					$("#weight").append(button);
				}
				isClicked = "motor";
			}
		});
		$("#truckbtn").click(function () {
			if (isClicked == "" || isClicked != "truck") {
				if ($("#weight").children().length > 0) {
					$("#weight").empty();
				}
				let weights = [250, 500, 700, 900];
				for (let i = 0; i < 4; i++) {
					let button = document.createElement("button");
					button.className = "btn btn-outline-success mx-2";
					button.setAttribute("value",weights[i]);
					button.innerText = weights[i] + " kg kadar";
					$("#weight").append(button);
				}
				isClicked = "truck";
			}
		});

		$(".phone").inputmask({"mask" : "(999) 999-9999"});
	})
</script>
