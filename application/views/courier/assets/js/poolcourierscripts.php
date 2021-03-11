<script>
	$(function () {
		$("#deletebtn").click(function(){
			$("input[type=text]").val("");
			$("#group_id").val(0);
			$("#user_is_active").val(0);
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
					data.user_id=$("#user_id").val();
					data.name=$("#name").val();
					data.surname=$("#surname").val();
					data.email=$("#email").val();
					data.group_id=$("#group_id").val();
					data.user_is_active=$("#user_is_active").val();
				}

			},
			"columns": [
				{"data": 'user_id'},
				{"data": 'name'},
				{"data": 'surname'},
				{"data": 'email'},
				{"data": 'group_name'},
				{"data": 'user_is_active'},
				{"data": 'created_time'},
				{"data": 'login_time'}
			],


			dom: 'Bfrtip',
			lengthMenu: [
				[10, 25, 50, 100],
				['10 satır', '25 satır', '50 satır', '100 satır']
			]


		});

		table.on('init.dt', function () {
			$('.addNewUser')
				.attr('data-toggle', 'modal')
				.attr('data-target', '#userAddModal');
		});

		$(".dataTables_filter").remove();

	});

</script>
