<script>
	$(function () {
		$("#deletebtn").click(function () {
			$("input[type=text]").val("");
			$("input[type=number]").val("");
			$("#vehicle_id").val(0);
			$("#city").val(0);
			table.ajax.reload();
		});

		$("#searchbtn").click(function () {
			table.ajax.reload();
		});

		var table = $("#listUserTable").DataTable({
			"language": {
				"url": "<?php echo base_url("assets/plugins/datatablelang/turkishlang.json")?>"
			},
			"processing": true,
			"serverSide": true,
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"searching": false,

			"ajax": {
				"url": "<?php echo $ajax_url; ?>",
				"type": "POST",
				"data": function (data) {
					data["cargo_description"] = $("#cargo_description").val();
					data["cargo_weight"]= $("#cargo_weight").val();
					data["cargo_volume"]= $("#cargo_volume").val();
					data["cargo_price>="]= $("#cargo_min_price").val();
					data["cargo_price<="]= $("#cargo_max_price").val();
					data["cargo_vehicle_id"] =$("#cargo_vehicle").val();
					data["cargo_adress_from_district_key"] = $("#district").val();
					/*data.cargo_description = $("#cargo_description").val()
					data.cargo_weight = $("#cargo_weight").val();
					data.cargo_volume = $("#cargo_volume").val();
					data.cargo_price = $("#cargo_price").val();
					data.cargo_vehicle = $("#cargo_vehicle_id").val();
					data.cargo_adress_from_district_key = $("#district").val()*/
				}
			},
			"columns": [
				{"data": 'cargo_id'},
				{"data": 'cargo_user_id'},
				{"data": 'cargo_description'},
				{"data": 'cargo_weight'},
				{"data": 'cargo_volume'},
				{"data": 'cargo_price'},
				{"data": 'cargo_vehicle_id'},
				{"data": 'cargo_adress_from_district_key'},
				{"data": 'cargo_adress_to_district_key'},
				{"data": 'cargo_delivery_time'},
				{"data": 'islem'},

			],


			lengthMenu: [
				[10, 25, 50, 100],
				['10 satır', '25 satır', '50 satır', '100 satır']
			]


		});


		$(".dataTables_filter").remove();

		$.ajax({
			method: "GET",
			url: "<?php echo base_url() . "courier/Poolcourier/getCityfromApi"?>"
		}).done(function (data) {
			let decoded_data = JSON.parse(data);
			//console.log(decoded_data.resultcity.result);
			decoded_data.resultcity.result.forEach(function (item) {
				$("#city").append("<option value='" + item.sehir_key + "'>" + item.sehir_title + "</option>");
			})

		})

		$("#city").change(function () {
			if ($("#city").val() != 0) {
				$("#district").html("");
				$.ajax({
					method: "POST",
					url: "<?php echo base_url() . "courier/Poolcourier/getDistrictfromApi"?>",
					data: {
						"plaka": $("#city").val()
					}
				}).done(function (data) {
					let decoded_data = JSON.parse(data);
					decoded_data.resultdistrict.result.forEach(function (item) {
						$("#district").append("<option value='" + item.ilce_id + "'>" + item.ilce_title + "</option>");
					})

				})
			} else {
				$("#district").html("");
				$("#district").append("<option value='0'>İlçe</option>");
			}
		})


		$.ajax({
			method : "GET",
			url : "<?php echo base_url(); ?>courier/Poolcourier/getVehiclefromApi"
		}).done(function(data){
			let decoded_data = JSON.parse(data);
			decoded_data.resultvehicle.result.forEach(function(item){
				$("#cargo_vehicle").append("<option value='" + item.vehicle_id + "'>" + item.vehicle_type + "</option>")
			})
		})
	});

</script>
