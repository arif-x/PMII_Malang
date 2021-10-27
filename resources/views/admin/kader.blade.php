@extends('layouts.admin-slider')

@section('content')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css">

<div class="mt-4">
	<h1 style="margin-bottom: 20px;">Kader</h1>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Filter</button>
	<a href="/admin/kader/export-kader" type="button" class="btn btn-primary">Export ke Excel (.xlxs)</a>
	<br />
	<br />
	<div class="table-responsive">
		<table class="table table-bordered data-tables">
			<thead>
				<tr>
					<th width="5%">No</th>
					<th width="">Nama</th>
					<th width="">Komisariat</th>
					<th width="">Tahun Bergabung</th>
					<th width="">Pekerjaan</th>
					<th width="">No. Telp.</th>
					<th width="">Detail</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>	
	</div>

	<div style="width: 100%">
		<div class="">
			<table class="table table-bordered data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="">Nama</th>
						<th width="">Komisariat</th>
						<th width="">Tahun Bergabung</th>
						<th width="">Pekerjaan</th>
						<th width="">No. Telp.</th>
						<th width="">Detail</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
		</div>
	</div>
</div>


<div class="">
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Filter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="GET" action="/admin/kader/filter">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="provinsi" class="col-form-label">Provinsi</label>

									<div class="">
										<select name="provinsi" class="form-control" style="text-transform: uppercase;">
											<option value="">Pilih Provinsi</option>
											@foreach ($provinsi as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="kabupaten" class="col-form-label">Kabupaten/Kota</label>

									<div class="">
										<select name="kabupaten" class="form-control" style="text-transform: uppercase;">
											<option value="">Pilih Kabupaten/Kota</option>
										</select>
										<i><small class="form-text text-muted">Pilih provinsi terelebih dahulu</small></i>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="kecamatan" class="col-form-label">Kecamatan</label>

									<div class="">
										<div class="">
											<select name="kecamatan" class="form-control" style="text-transform: uppercase;">
												<option value="">Pilih Kecamatan</option>
											</select>
											<i><small class="form-text text-muted">Pilih kabupaten terelebih dahulu</small></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="statusKawin" class="col-form-label">Status Pernikahan</label>

									<div class="">
										<select class="custom-select @error('statusKawin') is-invalid @enderror" name="statusKawin">
											<option value="">Pilih Status Pernikahan</option>
											<option value="Menikah">Menikah</option>
											<option value="Belum Menikah">Belum Menikah</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="pendidikan" class="col-form-label">Pendidikan Terakhir</label>

									<div class="">
										<select name="pendidikan" class="form-control">
											<option value="">Pilih Pendidikan</option>
											@foreach ($pendidikan as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="pekerjaan" class="col-form-label">Pekerjaan</label>

									<div class="">
										<select name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror">
											<option value="">Pilih Pekerjaan</option> 
											@foreach ($pekerjaan as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">							
							<div class="col-md-4">
								<div class="form-group">
									<label for="komisariatPenyelenggara" class="col-form-label">Komisariat</label>

									<div class="">
										<div class="form-group">                    

											<div class="">
												<select name="komisariatPenyelenggara" class="form-control">
													<option value="">Pilih Komisariat</option>
													@foreach ($komisariat as $key => $value)
													<option value="{{ $key }}">{{ $value }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="rayonPenyelenggara" class="col-form-label">Rayon</label>

									<div class="">
										<div class="form-group">                    

											<div class="">
												<select name="rayonPenyelenggara" class="form-control">
													<option value="">Pilih Rayon</option>
												</select>
												<i><small class="form-text text-muted">Pilih komisariat terelebih dahulu</small></i>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="kaderisasi" class="col-form-label">Kaderisasi Terakhir</label>

									<div class="">
										<select name="kaderisasi" class="form-control">
											<option value="">Pilih Kaderisasi Terakhir</option>
											@foreach ($kaderisasi as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="">
							<label for="tanggalLahir"Mulai class="col-form-label">Tanggal Lahir</label>
							<div class="row">								
								<div class="col-md-4">
									<label for="tanggalLahirMulai"Mulai class="col-form-label">Tanggal Lahir Awal</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #3b5998"><i class="fa fa-calendar" style="color: #fff"></i></span>
										</div>
										<input type="date" name="tanggalLahirMulai" class="form-control" id="validationTooltipUsername" placeholder="Tanggal Lahir" class="@error('tampat_lahir') is-invalid @enderror">
									</div>
								</div>

								<div class="col-md-4">
									<label for="tanggalLahirAkhir" class="col-form-label">Tanggal Lahir Akhir</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #3b5998"><i class="fa fa-calendar" style="color: #fff"></i></span>
										</div>
										<input type="date" name="tanggalLahirAkhir" class="form-control" id="validationTooltipUsername" placeholder="Tanggal Lahir" class="@error('tampat_lahir') is-invalid @enderror">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="tahun" class="col-form-label">Tahun Bergabung </label>

										<div class="">
											<select name="tahun" class="form-control">
												<option value="">Pilih tahun</option>
												@foreach ($tahun as $key => $value)
												<option value="{{ $key }}">{{ $value }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-primary" style="width: 100%">Proses</button>
						</div>						

					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-6">
		<div class="mt-5">
			<figure class="highcharts-figure">
				<div id="kaderisasi-terakhir"></div>
				<p class="highcharts-description">

				</p>
			</figure>
		</div>
	</div>

	<div class="col-md-6">
		<div class="mt-5">
			<figure class="highcharts-figure">
				<div id="pendidikan-terakhir"></div>
				<p class="highcharts-description">

				</p>
			</figure>
		</div>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-6">
		<div class="mt-5">
			<figure class="highcharts-figure">
				<div id="komisariats"></div>
				<p class="highcharts-description">

				</p>
			</figure>
		</div>
	</div>

	<div class="col-md-6">
		<div class="mt-5">
			<figure class="highcharts-figure">
				<div id="rayons"></div>
				<p class="highcharts-description">

				</p>
			</figure>
		</div>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-6">
		<div class="mt-5">
			<figure class="highcharts-figure">
				<div id="pekerjaans"></div>
				<p class="highcharts-description">

				</p>
			</figure>
		</div>
	</div>

	<div class="col-md-6">
		<div class="mt-5">
			<figure class="highcharts-figure">
				<div id="provinsis"></div>
				<p class="highcharts-description">
					
				</p>
			</figure>
		</div>
	</div>	
</div>

<hr>

<div class="row">	
	<div class="col-md-12">
		<div class="mt-5">
			<figure class="highcharts-figure">
				<div id="kabupatens"></div>
				<p class="highcharts-description">

				</p>
			</figure>
		</div>
	</div>
</div>

<style type="text/css">
	#map {
		position: relative;
		width: 100%;
		height: 500px;
	}
</style>

<div class="mt-5 mb-3">
	<h5 class="text-center">Data Persebaran Kader Berdasarkan Peta</h5>
	<div id="map"></div>
</div>


<!-- Script Chart Kaderisasi Terakhir -->
<script type="text/javascript">
	Highcharts.chart('kaderisasi-terakhir', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Data Kader Berdasarkan Kaderisasi Terakhir'
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kader'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Jumlah Kader <b>{point.y:.0f}</b>'
		},
		series: [{
			name: 'Jumlah Kader',
			data: [
			@foreach ($kaders as $kader)

			['{{ $kader->kaderisasi_terakhir }}', {{ $kader->jumlah_kaderisasi }}],

			@endforeach
			
			],
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				y: 10,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
</script>

<!-- Script Chart Pendidikan Terakhir -->
<script type="text/javascript">
	Highcharts.chart('pendidikan-terakhir', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Jumlah Kader Berdasarkan Pendidikan Terakhir'
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kader Berdasarkan Pendidikan Terakhir'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Jumlah Kader <b>{point.y:.0f}</b>'
		},
		series: [{
			name: 'Jumlah Kader',
			data: [
			@foreach ($pendidikans as $pendidikan)

			['{{ $pendidikan->pendidikan }}', {{ $pendidikan->jumlah_pendidikan }}],

			@endforeach
			
			],
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				y: 10,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
</script>

<!-- Script Chart Pekerjaan -->
<script type="text/javascript">
	Highcharts.chart('pekerjaans', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Jumlah Kader Berdasarkan Pekerjaan'
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kader Berdasarkan Pekerjaan'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Jumlah Kader <b>{point.y:.0f}</b>'
		},
		series: [{
			name: 'Jumlah Kader',
			data: [
			@foreach ($pekerjaans as $pekerjaan)

			['{{ $pekerjaan->kerja }}', {{ $pekerjaan->jumlah_pekerjaan }}],

			@endforeach
			
			],
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				y: 10,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
</script>

<!-- Script Chart Komisariat -->
<script type="text/javascript">
	Highcharts.chart('komisariats', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Jumlah Kader Berdasarkan Komisariat'
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kader Berdasarkan Komisariat'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Jumlah Kader <b>{point.y:.0f}</b>'
		},
		series: [{
			name: 'Jumlah Kader',
			data: [
			@foreach ($komisariats as $komisariat)

			['{{ $komisariat->nama_komisariat }}', {{ $komisariat->jumlah_komisariat }}],

			@endforeach
			
			],
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				y: 10,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
</script>

<!-- Script Chart Rayon -->
<script type="text/javascript">
	Highcharts.chart('rayons', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Jumlah Kader Berdasarkan Rayon'
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kader Berdasarkan Rayon'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Jumlah Kader <b>{point.y:.0f}</b>'
		},
		series: [{
			name: 'Jumlah Kader',
			data: [
			@foreach ($rayons as $rayon)

			['{{ $rayon->nama_rayon }}', {{ $rayon->jumlah_rayon }}],

			@endforeach
			
			],
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				y: 10,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
</script>

<!-- Script Chart Provinsi -->
<script type="text/javascript">
	Highcharts.chart('provinsis', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Jumlah Kader Berdasarkan Provinsi'
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kader Berdasarkan Provinsi'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Jumlah Kader <b>{point.y:.0f}</b>'
		},
		series: [{
			name: 'Jumlah Kader',
			data: [
			@foreach ($provinsis as $provinsi)

			['{{ $provinsi->name }}', {{ $provinsi->jumlah_provinsi }}],

			@endforeach
			
			],
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				y: 10,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
</script>

<!-- Script Chart Kabupaten -->
<script type="text/javascript">
	Highcharts.chart('kabupatens', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Jumlah Kader Berdasarkan Kabupaten'
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Kader Berdasarkan Kabupaten'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Jumlah Kader <b>{point.y:.0f}</b>'
		},
		series: [{
			name: 'Jumlah Kader',
			data: [
			@foreach ($kabupatens as $kabupaten)

			['{{ $kabupaten->name }}', {{ $kabupaten->jumlah_kabupaten }}],

			@endforeach
			
			],
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				y: 10,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
</script>

<!-- Script Map -->
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiYXJpcG9uIiwiYSI6ImNrbjV3cmZ5NTA4aDUyd25zenk3MmlwYzgifQ.YbJ_Ir794eD8VlrVvpX64g';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',            
		center: [112.6326321, -7.5666204],
		zoom: 7
		// center: [116.8528526, -1.2379274],
		// zoom: 5
	});

	map.addControl(new mapboxgl.NavigationControl());
	map.addControl(new mapboxgl.FullscreenControl());

	map.on('load', function() {
		map.resize();
	});

	const size = 100;

	const pulsingDot = {
		width: size,
		height: size,
		data: new Uint8Array(size * size * 4),

		onAdd: function () {
			const canvas = document.createElement('canvas');
			canvas.width = this.width;
			canvas.height = this.height;
			this.context = canvas.getContext('2d');
		},

		render: function () {
			const duration = 1000;
			const t = (performance.now() % duration) / duration;

			const radius = (size / 2) * 0.3;
			const outerRadius = (size / 2) * 0.3 * t + radius;
			const context = this.context;

			context.clearRect(0, 0, this.width, this.height);
			context.beginPath();
			context.arc(
				this.width / 2,
				this.height / 2,
				outerRadius,
				0,
				Math.PI * 2
				);
			context.fillStyle = `rgba(253, 255, 117, ${1 - t})`;
			context.fill();

			context.beginPath();
			context.arc(
				this.width / 2,
				this.height / 2,
				radius,
				0,
				Math.PI * 2
				);
			context.fillStyle = 'rgba(49, 42, 250, 1)';
			context.strokeStyle = 'white';
			context.lineWidth = 2 + 4 * (1 - t);
			context.fill();
			context.stroke();

			this.data = context.getImageData(
				0,
				0,
				this.width,
				this.height
				).data;

			map.triggerRepaint();

			return true;
		}
	};

	map.on('load', function () {
		map.addImage('pulsing-dot', pulsingDot, { pixelRatio: 2 })
		map.addSource('points', {
			'type': 'geojson',
			'data': {
				'type': 'FeatureCollection',
				'features': [
				@foreach ($koordinats as $koordinat)
				{                    			
					"type": "Feature",
					"properties": {
						// "title": "{{ $koordinat->kab }}",
						"description": "<strong>{{ $koordinat->kab }}<br>Jumlah Kader: {{ $koordinat->jml }}</strong><br><?php echo str_replace(',', '<br>- ', '- '.$koordinat->nama) ?>",
						"marker-color": "#f86767",
						"marker-size": "large",
						"marker-symbol": "star"
					},
					"geometry": {
						"type": "Point",
						"coordinates": ['{{ $koordinat->lng }}', '{{ $koordinat->lat }}']
					}
				},
				@endforeach
				]
			}
		});

		map.addLayer({
			'id': 'points',
			'type': 'symbol',
			'source': 'points',
			'layout': {
				'icon-image': 'pulsing-dot',
				'text-field': ['get', 'title'],
				'text-font': [
				'Open Sans Semibold',
				],
				'text-offset': [0, 1],
				'text-anchor': 'top'
			}
		});

		map.on('click', 'points', function (e) {
			var coordinates = e.features[0].geometry.coordinates.slice();
			var description = e.features[0].properties.description;
			while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
				coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
			}

			new mapboxgl.Popup()
			.setLngLat(coordinates)
			.setHTML(description)
			.addTo(map);
		});

		map.on('mouseenter', 'points', function () {
			map.getCanvas().style.cursor = 'pointer';
		});

		map.on('mouseleave', 'points', function () {
			map.getCanvas().style.cursor = '';
		});
	});
</script>

<script type="text/javascript">
	$(function () {
		$('.data-tables').hide();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var table = $('.data-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "/admin/kader/all",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nama_lengkap', name: 'nama_lengkap'},
			{data: 'nama_komisariat', name: 'nama_komisariat'},
			{data: 'tahun_bergabung', name: 'tahun_bergabung'},
			{data: 'pekerjan', name: 'pekerjan'},
			{data: 'no_hp', name: 'no_hp'},
			{data: 'detail', name: 'detail', orderable: false, searchable: false},
			]
		});
	});

	$('select[name="provinsi"]').on('change', function() {
		var kab = $(this).val();
		if(kab) {
			$.ajax({
				url: '/get-kabupaten/'+kab,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="kabupaten"]').empty();
					$('select[name="kecamatan"]').empty();
					$.each(data, function(key, value) {
						$('select[name="kabupaten"]').append('<option value="'+ key +'">'+ value +'</option>');
					});
				}
			});
		} else {
			$('select[name="kabupaten"]').empty();                
		}
	});

	$('select[name="kabupaten"]').on('change', function() {
		var kec = $(this).val();
		if(kec) {
			$.ajax({
				url: '/get-kecamatan/'+kec,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="kecamatan"]').empty();
					$.each(data, function(key, value) {
						$('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
					});
				}
			});
		} else {
			$('select[name="kecamatan"]').empty();
		}
	});

	$('select[name="komisariatPenyelenggara"]').on('change', function() {
		var komId = $(this).val();
		if(komId) {
			$.ajax({
				url: '/get-rayon/'+komId,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="rayonPenyelenggara"]').empty();
					$.each(data, function(key, value) {
						$('select[name="rayonPenyelenggara"]').append('<option value="'+ key +'">'+ value +'</option>');
					});
				}
			});
		} else {
			$('select[name="rayonPenyelenggara"]').empty();
		}
	});
</script>

<script type="text/javascript">
	$('#kader').addClass('active');
</script>
@endsection