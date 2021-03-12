<script>
	$(function () {
		$("#deletebtn").click(function(){
			$("input[type=text]").val("");
			//$("#group_id").val(0);
			//$("#user_is_active").val(0);
			table.ajax.reload();
		});

		$("#searchbtn").click(function(){
			table.ajax.reload();
		});

		var table = $("#listUserTable").DataTable({
			"language": {
				"url":"<?php echo base_url("assets/plugins/datatablelang/turkishlang.json")?>"
			},
			"processing": true,
			"serverSide": true,
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"searching": false,

			"ajax": {
				"url": "<?php echo $ajax_url; ?>",
				"type": "POST",
				"data":function(data){
					data.cargo_description=$("#cargo_description").val();
					data.cargo_weight=$("#cargo_weight").val();
					data.cargo_volume=$("#cargo_volume").val();
					data.cargo_price=$("#cargo_price").val();
					data.cargo_vehicle=$("#cargo_vehicle_id").val();
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


	});

</script>
