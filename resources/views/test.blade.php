<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-----<title>Responsive Profile Cards | CodingLab</title>----->
	<!-- <link rel="stylesheet" href="style.css"> -->
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

		.gr{
			display: grid;
			height: 100%;
			place-items: center;
		}
		.containers{
			max-width: 1100px;
			display: flex;
			justify-content: flex;
			align-items: center;
			flex-wrap: wrap;
			padding: 20px;
		}
		.containers .box{
			width: 15%;
			background: #fff;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			padding: 20px;
			margin: 2px;
			border-radius: 5px;
			border: 3px solid #000;
		}
		.box .quote i{
			margin-top: 10px;
			font-size: 45px;
			color: #17c0eb;
			border
		}
		.containers .box .image{
			margin: 10px 0;
			height: 150px;
			width: 150px;
			background: #8e44ad;
			padding: 3px;
			border-radius: 50%;
		}
		.box .image img{
			height: 100%;
			width: 100%;
			border-radius: 50%;
			object-fit: cover;
			border: 2px solid #fff;
		}
		.box p{
			text-align: justify;
			margin-top: 8px;
			font-size: 16px;
			font-weight: 400;
		}
		.box .name_job{
			margin: 10px 0 3px 0;
			color: #8e44ad;
			font-size: 18px;
			font-weight: 600;
		}
		.rating i{
			font-size: 18px;
			color: #8e44ad;
			margin-bottom: 5px;
		}
		.btns{
			margin-top: 20px;
			margin-bottom: 5px;
			display: flex;
			justify-content: space-between;
			width: 100%;
		}
		.btns button{
			background: #8e44ad;
			width: 100%;
			padding: 9px 0px;
			outline: none;
			border: 2px solid #8e44ad;
			border-radius: 5px;
			cursor: pointer;
			font-size: 18px;
			font-weight: 400;
			color: #8e44ad;
			transition: all 0.3s linear;
		}
		.btns button:first-child{
			background: none;
			margin-right: 5px;
		}
		.btns button:last-child{
			color: #fff;
			margin-left: 5px;
		}
		.btns button:first-child:hover{
			background: #8e44ad;
			color: #fff;
		}
		.btns button:hover{
			color: #fff;
		}
		@media (max-width:1045px){
			.containers .box{
				width: calc(50% - 10px);
				margin-bottom: 20px;
			}
		}
		@media (max-width:710px){
			.containers .box{
				width: 100%;
			}
		}

	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
	<div class="gr">
		<div class="containers">
			<div class="box">
				<div class="image">
					<!-----<img src="img1.jpeg">------->
				</div>
				<div class="name_job">David Chrish</div>
				<div class="rating">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="far fa-star"></i>
					<i class="far fa-star"></i>
					<i class="far fa-star"></i>
				</div>
				<p> Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.</p>
				<div class="btns">
					<button>Read More</button>
					<button>Subscribe</button>
				</div>
			</div>
			<div class="box">
				<div class="image">
					<!------  <img src="img2.jpeg" alt="">--->
				</div>
				<div class="name_job">Kristina Bellis</div>
				<div class="rating">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="far fa-star"></i>
					<i class="far fa-star"></i>
				</div>
				<p> Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.</p>
				<div class="btns">
					<button>Read More </button>
					<button>Subscribe</button>
				</div>
			</div>
			<div class="box">
				<div class="image">
					<!---- <img src="img3.jpeg" alt="">---->
				</div>
				<div class="name_job">Stephen Marlo</div>
				<div class="rating">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="far fa-star"></i>
				</div>
				<p> Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.</p>
				<div class="btns">
					<button>Read More</button>
					<button>Subscribe</button>
				</div>
			</div>

			<div class="box">
				<div class="image">
					<!---- <img src="img3.jpeg" alt="">---->
				</div>
				<div class="name_job">Stephen Marlo</div>
				<div class="rating">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="far fa-star"></i>
				</div>
				<p> Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.</p>
				<div class="btns">
					<button>Read More</button>
					<button>Subscribe</button>
				</div>
			</div>

			<div class="box">
				<div class="image">
					<!---- <img src="img3.jpeg" alt="">---->
				</div>
				<div class="name_job">Stephen Marlo</div>
				<div class="rating">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="far fa-star"></i>
				</div>
				<p> Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.</p>
				<div class="btns">
					<button>Read More</button>
					<button>Subscribe</button>
				</div>
			</div>


		</div>
	</div>
</body>
</html>
