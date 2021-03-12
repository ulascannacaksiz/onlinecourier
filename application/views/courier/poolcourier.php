<div class="content">
	<div class="container-fluid p-5">
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">Teslim Edilmeyi Bekleyen Gönderiler</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="form-group ml-2">
						<input type="text" class="form-control" name="cargo_description" id="cargo_description"
							   placeholder="Kargo Açıklaması">
					</div>
					<div class="form-group ml-2">
						<input type="number" class="form-control" name="cargo_weight" id="cargo_weight"
							   placeholder="Kargo Ağırlığı">
					</div>

					<div class="form-group ml-2">
						<input type="number" class="form-control" name="cargo_volume" id="cargo_volume"
							   placeholder="Hacim">
					</div>

					<div class="form-group ml-2">
						<select name="cargo_vehicle" id="cargo_vehicle" class="form-control">
							<option value="0" selected>Araç Tipi</option>

						</select>
					</div>
					<div class="form-group ml-2">
						<select name="city" id="city" class="form-control">
							<option value="0" selected>Şehir</option>

						</select>
					</div>
					<div class="form-group ml-2">
						<input type="number" class="form-control" name="cargo_price" id="cargo_price"
							   placeholder="Ücret" min="1">
					</div>
						<div class="form-group ml-2">
							<button name="searchbtn" id="searchbtn" class="btn btn-outline-info">
								<i class="fa fa-search"></i> Ara
							</button>
							<button name="deletebtn" id="deletebtn" class="btn btn-outline-danger">
								<i class="fa fa-times"></i> Temizle
							</button>
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
							<th>Araç Tipi</th>
							<th>Çıkış Noktası</th>
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
