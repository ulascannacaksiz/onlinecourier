<div class="content">
	<div class="container-fluid p-5">
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">Teslim Edilmeyi Bekleyen Gönderiler</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="form-group ml-2">
						<input type="text" class="form-control" name="user_id" id="user_id"
							   placeholder="Kargo Açıklaması">
					</div>
					<div class="form-group ml-2">
						<input type="text" class="form-control" name="name" id="name"
							   placeholder="Kargo Ağırlığı">
					</div>
					<div class="form-group ml-2">
						<select name="group_id" id="group_id" class="form-control">
							<option value="0" selected>Kargo Birim Ağırlığı</option>
							<?php foreach ($result_group['result'] as $grp) {
								echo '<option value="' . $grp->group_id . '">' . $grp->group_name . '</option>';
							} ?>
						</select>
					</div>
					<div class="form-group ml-2">
						<input type="text" class="form-control" name="name" id="name"
							   placeholder="Hacim">
					</div>
					<div class="form-group ml-2">
						<input type="text" name="email" id="email" class="form-control"
							   placeholder="Teslim Tarihi">
					</div>
					<div class="form-group ml-2">
						<select name="group_id" id="group_id" class="form-control">
							<option value="0" selected>Araç Tipi</option>
							<?php foreach ($result_group['result'] as $grp) {
								echo '<option value="' . $grp->group_id . '">' . $grp->group_name . '</option>';
							} ?>
						</select>
					</div>
					<div class="form-group ml-2">
						<input type="text" class="form-control" name="name" id="name"
							   placeholder="Minimum Ücret">
					</div>
					<div class="form-group ml-2">
						<input type="text" class="form-control" name="name" id="name"
							   placeholder="Maximum Ücret">
					</div>
					<div class="form-group ml-2">
						<button name="searchbtn" id="searchbtn" class="btn btn-outline-info"><i
									class="fa fa-search"></i> Ara </button>
						<button name="deletebtn" id="deletebtn" class="btn btn-outline-danger"><i
									class="fa fa-times"></i> Temizle </button>
					</div>
				</div>
				<table class="table table-bordered" id="listUserTable">
					<thead>
					<tr>
						<th>No</th>
						<th>Gönderen</th>
						<th>Açıklama</th>
						<th>Ağırlık/Ağırlık Birimi</th>
						<th>Hacim</th>
						<th>Ücret</th>
						<th>Varış Noktası</th>
						<th>Teslim Tarihi</th>
						<th>İşlem</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>


			</div>

		</div>


	</div>
</div>
