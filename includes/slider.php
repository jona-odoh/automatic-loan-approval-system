<div class="slider" id="slider">
								<?php
								$result = $db->prepare("SELECT lplan_interest FROM loan_plan WHERE id = 10  ");
								$result->execute();
								for ($i = 1; $row = $result->fetch(); $i++) {
									?>
		<!-- slider -->
		<div class="slider-gradient-img"><img src="images/index-three-slider-2.jpg" alt="Borrow - Loan Company Website Template" class="">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="slider-captions">
							<!-- slider-captions -->
							<h1 class="slider-title">Simple, Secure and Affordable Rate</h1>
							<p class="slider-text d-none d-xl-block d-lg-block d-md-block">The low rate you need for the need you want! Call
								<br>
								<strong class="text-highlight">(+234) 906 363 3140</strong></p>
							<a href="team.html" class="btn btn-outline">Loan Products</a> </div>
						<!-- /.slider-captions -->
					</div>
				</div>
			</div>
		</div>
		<div>
			<div class="slider-gradient-img"><img src="images/index-three-slider-3.jpg" alt="Borrow - Loan Company Website Template" class="">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="slider-captions">
								<!-- slider-captions -->
								<h1 class="slider-title"> Lowest Car Loan Rate <strong class="text-highlight"><?php echo $row['lplan_interest']; ?>%</strong> </h1>
								<p class="slider-text d-none d-xl-block d-lg-block d-md-block"> We provide an excellent service Loan company. Lorem ipsum simple dummy content goes here.</p>
								<a href="#" class="btn btn-default ">Check Eligiblity</a> </div>
							<!-- /.slider-captions -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div class="slider-gradient-img"><img src="images/index-three-slider-1.jpg" alt="Borrow - Loan Company Website Template" class="">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="slider-captions">
								<!-- slider-captions -->
								<h1 class="slider-title">Student Loans with Greate Rates <strong class="text-highlight"><?php echo $row['lplan_interest']; ?>%</strong></h1>
								<p class="slider-text d-none d-xl-block d-lg-block d-md-block">We provide an excellent service for all types of loans in
									<br> ahmedabad and offer service, advice and direction.</p>
								<a href="#" class="btn btn-default">View Products</a> </div>
							<!-- /.slider-captions -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><?php } ?>