<div class="content">
	<div class="container-fluid p-5">
		<h1 class="display-4 font-weight-bold">Gönderi</h1>
		<div class="row">

			<div class="col-md-12 text-center font-weight-bold">Ne zaman alınmalı ve teslim edilmeli?</div>
			<div class="col-md-12">
				<div class="d-flex justify-content-center my-2">
					<div class="mx-2">
						<button class="btn btn-outline-success btn-lg">
							<div class="d-flex align-items-center">
								<i class="fas fa-running"></i>
								<span class="mx-2">En Kısa Sürede</span>
							</div>
						</button>
					</div>
					<div class="mx-2">
						<button class="btn btn-outline-success btn-lg">
							<div class="d-flex align-items-center">
								<i class="far fa-clock"></i>
								<span class="mx-2">Belirtilen Zamanda</span>
							</div>
						</button>
					</div>
				</div>
				<div class="col-md-12 text-center font-weight-bold my-2">
					Araç Tipi
				</div>
				<div class="d-flex justify-content-center">
					<div class="mx-2">
						<button class="btn btn-outline-success btn-md" id="carbtn">Araba</button>
					</div>
					<div class="mx-2">
						<button class="btn btn-outline-success btn-md" id="motorbtn">Motor</button>
					</div>
					<div class="mx-2">
						<button class="btn btn-outline-success btn-md" id="truckbtn">Kamyon</button>
					</div>

				</div>
				<div class="d-flex justify-content-center my-2" id="weight"></div>
				<div class="col-md-8 mx-auto">
					<div class="card">
						<div class="card-body">
							<label>Çıkış Adresi</label>
							<br>
							<label>İsim</label>
							<input type="text" class="form-control" placeholder="İsim">
							<label>Soyisim</label>
							<input type="text" class="form-control" placeholder="Soyisim">
							<label>Numara</label>
							<input type="text" class="form-control phone" placeholder="Numara">
							<label>Adres</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i
												class="fas fa-map-marker-alt"></i></span>
								</div>
								<input type="text" class="form-control" placeholder="Çıkış Adresi...">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 mx-auto">
					<div class="card">
						<div class="card-body">
							<label>Varış Adresi</label>
							<br>
							<label>İsim</label>
							<input type="text" class="form-control" placeholder="İsim">
							<label>Soyisim</label>
							<input type="text" class="form-control" placeholder="Soyisim">
							<label>Numara</label>
							<input type="text" class="form-control phone" placeholder="Numara">
							<label>Adres</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i
												class="fas fa-map-marker-alt"></i></span>
								</div>
								<input type="text" class="form-control" placeholder="Varış Adresi..."
									   aria-label="Username"
									   aria-describedby="basic-addon1">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 mx-auto">
					<div class="card">
						<div class="card-body">
							<label>Gönderi İçeriği</label>
							<input type="text" class="form-control" placeholder="Gönderi İçeriği">
						</div>
					</div>
				</div>
				<div class="col-md-8 mx-auto">
					<button class="btn btn-outline-success">Gönderi Oluştur</button>
					<div class=""></div>
				</div>
			</div>
		</div>
	</div>
</div>



