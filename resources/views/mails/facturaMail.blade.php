<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<title>Facturas - DeCroche</title>
					<link rel="stylesheet" href="../animacion-inicio/facturas/dist/style.css">
					<link rel="preconnect" href="https://fonts.googleapis.com">
						<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
						<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

						<!-- Icon Font Stylesheet -->
						<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
						<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

						<!-- Libraries Stylesheet -->
						<link href="../animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
						<link href="../animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


						<!-- Customized Bootstrap Stylesheet -->
						<link href="../animacion-inicio/carrito/css/bootstrap.min.css" rel="stylesheet">

						<!-- Template Stylesheet -->
						<link href="../animacion-inicio/carrito/css/style.css" rel="stylesheet">

						<link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">
						<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


						<style>
		#invoice-POS {
			max-width: 450px;
			box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
			padding: 5mm;
			margin: 20px;
			width: 80%;
			background: #FFF;
			float: left;
			margin-right: 20px;
			margin-bottom: 20px;
		}
		
		#invoice-POS h1,
		#invoice-POS h2,
		#invoice-POS h3,
		#invoice-POS p {
			font-size: 1em;
			color: #222;
			line-height: 1.5em;
		}
		
		#invoice-POS #top,
		#invoice-POS #mid,
		#invoice-POS #bot {
			border-bottom: 1px solid #EEE;
		}
		
		#invoice-POS #top {
			min-height: 100px;
		}
		
		#invoice-POS #mid {
			min-height: 80px;
		}
		
		#invoice-POS #bot {
			min-height: 50px;
		}
		
		#invoice-POS #top .logo {
			height: 80px;
			width: 80px;
			background: url(https://raw.githubusercontent.com/chechojgb/images/main/conejo.jfif) no-repeat;
			background-size: 80px 80px;
			border-radius: 40%;
		}
		
		#invoice-POS .clientlogo {
			float: left;
			height: 60px;
			width: 60px;
			background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
			background-size: 60px 60px;
			border-radius: 50px;
		}
		
		#invoice-POS .info {
			display: block;
			margin-left: 0;
		}
		
		#invoice-POS .title {
			float: right;
		}
		
		#invoice-POS .title p {
			text-align: right;
		}
		
		#invoice-POS table {
			width: 100%;
			border-collapse: collapse;
		}
		
		#invoice-POS .tabletitle {
			font-size: 0.5em;
			background: #EEE;
		}
		
		#invoice-POS .service {
			border-bottom: 1px solid #EEE;
		}
		
		#invoice-POS .item {
			width: 24mm;
		}
		
		#invoice-POS .itemtext {
			font-size: 1.5em;
		}
		
		#invoice-POS #legalcopy {
			margin-top: 5mm;
		}
		
		#invoice-POS:nth-child(3n) {
			clear: both;
		}

		</style>
				</head>
				<body>
					<div id="invoice-POS">
					<center id="top">
						<div class="logo"></div>
						<div class="info"> 
							<h2>Factura N-{{ $id_factura }}</h2>
						</div><!--End Info-->
					</center><!--End InvoiceTop-->
					
					<div id="mid">
						<div class="info">
							<h2>Información de factura</h2>
							<p> 
								Dirección: {{ $direccion }}<br><br>
								Ciudad: {{ $ciudad }}<br><br>
								Correo: {{ $correo }}<br><br>
								Telefono: {{ $celular }}<br><br>
								nombre: {{ $nombre_completo }} <br>
							</p>
						</div>
					</div><!--End Invoice Mid-->
					
					<div id="bot">
						<div id="table">
							<table>
								<tr class="tabletitle">
									<td class="item" style="padding-left: 10px"><h2 style="font-size: 10px">Producto</h2></td>
									<td class="Hours" style="padding-left: 25px">   <h2 style="font-size: 10px">Cant</h2></td>
									<td class="Rate" style="padding-left: 15px"><h2 style="font-size: 13px">Sub Total</h2></td>
								</tr>
								@php
									$total = 0;
								@endphp

								@if(isset($det_facturas) && isset($productos))
									@foreach ($det_facturas as $detalle)
										@php
											$producto = $productos->firstWhere('id_pro', $detalle->producto_id);
											$subtotal = $detalle->cantidad * $producto->precio;
											$total += $subtotal;
										@endphp

										<tr class="service">
											<td class="tableitem"><p class="itemtext" style="font-size: 13px; padding-left: 10px">{{ $producto->nombre }}</p></td>
											<td class="tableitem" style="padding-left: 30px"><p class="itemtext" style="font-size: 13px">{{ $detalle->cantidad }}</p></td>
											<td class="tableitem" style="padding-left: 15px"><p class="itemtext" style="font-size: 13px">${{ number_format($subtotal, 2) }}</p></td>
										</tr>
									@endforeach
								@else
									<p>No se encontraron datos.</p>
								@endif
							
									



								<tr class="tabletitle">
									<td></td>
									<td class="Rate"><h2 style="font-size: 20px">Total</h2></td>
									<td class="payment"><h2 style="font-size: 20px">{{number_format($total)}}</h2></td>
								</tr>
							</table>
						</div><!-- End Table -->

						<div id="legalcopy">
							<p class="legal"><strong>Gracias por comprar con DeCroche!</strong> te esperamos en la siguiente compra</p>
						</div>
					</div>
				</body>
				</html>