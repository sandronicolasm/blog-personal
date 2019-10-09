		 
//		 animated
		 new WOW().init();
		 
//		 Menu Toggle 
		 $(document).ready(function(){
			 $('.sidebarBtn').click(function(){
				$('.sidebar').toggleClass('active');
				$('.sidebarBtn').toggleClass('toggle');
			 });
		 });
		 
		 //		Page Scrolling
		$(document).ready(function(){
			$("a").on('click', function(event) {
				if (this.hash !== "") {
					var hash = this.hash;
					$('html, body').animate({
						scrollTop: $(hash).offset().top
					});
				}
			});

		})
		 
		 
//		 Typed text
		 $(function(){
			 $('.type').typed({
				 strings: [
					 "This is Resume.",
					 "Awesome Creative Designs.",
					 "Full Responsive.",
					 "love Simplicity.",
				 ],
				 typeSpeed: 20,
				 backDelay: 1500,
				 loop: true
			 });
		 });
		 
//		 Owl Carousel
		 $(document).ready(function() {
              $('#owl-about').owlCarousel({
               	items: 1,
				animateIn: 'fadeIn',
                margin: 10,
                autoHeight: false,
				navText: ['<i class="fa fa-angle-left">','</i><i class="fa fa-angle-right"></i>'],
				
              });
			 
			 $('#owl-skills').owlCarousel({
				items:1,
				loop:true,
				margin:10,
				nav:true,
				dots:false,
				autoplay:true,
				navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			 })
         });
