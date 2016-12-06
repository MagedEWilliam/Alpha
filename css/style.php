<style type="text/css">
	body.pushable>.pusher{
		background-color: #f4f4f4;
		border-collapse: collapse;
	}

	#activeNav{
		position: absolute;
		background-color: #f7da00;
		height: 10px;
		left: -5px;
		right: -5px;

		bottom: -25px
	}
	#mysidebarmenu{
		overflow: hidden;
		height: 150px;
		padding-bottom: 30px;
		-webkit-transition: height .1s ease;
		transition: height .1s ease;
	}
	#mysidebarmenu:hover{
		overflow: visible;
	}
	.amazonmenu{
		position: relative;
	}

	.floatright{
		float: right !important;
	}
	.floatleft{
		float: left !important;
	}
	.tail{
		position: fixed;
		right: 0;
		top: 0;
	}

	.shadowmore{
		width: 100%;
		height: 20px;
		position: absolute;
		bottom: 30px;
		background-image: url(../assets/shadowup.png);
		background-repeat: no-repeat;
	}
	.showmore{
		width: 100%;
		height: 30px;
		background-color: #fff;
		text-align: center;
		position: absolute;
		bottom: 0px;
		color: #777;
	}
	.filtr{
		margin-top: 10px  !important;
	}

	.ui.list .list>.item a.header, .ui.list>.item a.header:hover{color: #ffffff;}
	#topnav{
		height: 75px;
		width: 100%;
		background-color: #f4f4f4;
		line-height: 1 !important;
	}

	.nopad{
		padding: 0 !important;
	}
	.rpad{
		padding-right: 0 !important;	
	}

	.slpad{
		padding-left: 4px !important;	
		text-overflow:ellipsis;
	}

	.ui.move.reveal {
		white-space: normal;
	}

	.nomarg{
		margin: 0 !important;
	}

	.nobox{
		box-shadow: none !important;
	}

	.heigh{
		height: 100%;
		width: 100%;
	}

	.widt{
		width: 100%;
	}
	.notopmarg{
		margin-top: 5px !important;
	}
	.norm{
		font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;
	}

	.parento{
		height: 150px;
	}

	.getdown{
		padding-top: 5px;
		display:inline-block
		height: 100%;
	}

	.detailtable{
		margin-bottom:0;
		width:100%;
	}

	.fillitup{
		width: 100%;
	}

	.gentleH{
		height: 5px;
		width: 1px;
	}

	.fastdetails{
		position: absolute;
		bottom: 0;
		width:100%;
	}

	.rtl{
		text-align: right !important;
	}

	.longy{
		height: 400px !important;
	}

	.longproduct{
		width: 315px !important;
	}

	@font-face {
		font-family: 'goodtime';
		src: url(../assets/good_times_rg.ttf);
	}

	@font-face {
		font-family: 'Bahij';
		src: url(../assets/Bahij_TheSansArabic-Bold.ttf);
	}

	@font-face {
		font-family: 'NotoSansSC';
		src: url(../assets/NotoSansSC-Bold.otf);
	}

	.goodtimes{
		font-family: goodtime, Bahij, 'NotoSansSC' !important;
	}

	.breakit{
		width:100px;
		content: "\A" !important;
		white-space: pre !important;
	}

	.Fixedtd{
		width: 105px !important;
	}

	.smallfont{
		font-size: 12px;
	}
	.ui.dropdown.hundredinwidth .menu {
		left:auto !important;
		right: 0 !important;
	}
	.hundredinwidth{
		margin-top: 31px;
		float: right;
	}

	.ui.dropdown .menu>.item {
		font-size: 12px;	
	}

	.top-nav-group {
		text-align: center !important;
	}

	.top-nav-group a {
		margin: 0px 1% 0px 1%;
		position: relative;
	}

	.top-nav-sub-group{
		margin-top: 25px;
	}
	.top-nav-sub-group a{
		color: #0061a5;
	}

	.tel-space{
		float: left;
		text-align: left;
		width: 160px;
		padding-top: 29px;
		margin-bottom: 5px;
	}

	.some-margin{
		margin-top:25px;
	}

	.logo img{
		position: absolute;
		top:0px;
		width: 65px;
	}

	.alpha{
		margin-top: 20px;
		margin-left:65px;
		font-size: 25px;
		color: #0061a5;
	}

	#line2{
		float: left;
		width:100%;
		margin-top: 4px;
		height: 10px;
		background-color: #0061a5;
	}
	#line1{
		width:100%;
		margin-top: 16px;
		height: 10px;
		background-color: #0061a5;
	}
	#line0 p{
		font-size: 8px;
		color: #f7da00;
		padding-left: 17px;
		letter-spacing: 1px;
	}
	#line0{
		float: right;
		width:89%;
		margin-top: 10px;
		height: 10px;
		background-color: #0061a5;
	}

	.submenumob{
		color: #000;
		font-size: 17px;
		padding-right: 10px;
	}
	.mobilefil{
		display: none;
	}

	.thumpimg{
		width: 50px;
	}

	.front.content{
		display: block;
	}

	div.ui.image.longy{
	    overflow: visible;
	}
	#mysidebarmenu{
		z-index: 999;
	}
	#Home-nav{
		color: #0061a5;
	}
	@media only screen and (min-width: 1280px){
		.ui.container {
			width: 92%;
		}
		.ui.selection.dropdown.lang{
			min-width: 130px;
			padding-right: 5px; 
		}
		.ui.selection.dropdown.lang .farright{
			right:0;
		}
		.ui.selection.dropdown.lang {
			margin-top: 17px;
		}
		.top-nav-sub-group{
			width: 90%;
		}
	}

	@media only screen and (max-width: 1279px){
		.top-nav-group a {
			font-size: 10px;
		}
		.tel-space{
			text-align: right;
			margin-bottom: 8px;
		}
		.lang {
			float: right;
		}
		
		.smallfont{
			font-size: 10px;
		}
		#activeNav{
			bottom: -26px
		}
		#line0 p{
			padding-left: 35px;
			padding-top: 1px;
			font-size: 7px;
		}
		.showmore{
			font-size: 10px;
		}
	}

	@media only screen and (max-width: 1199px){
		p.tel-space{
			float: right !important;
			margin-bottom: 0px;
			padding-top: 10px;
			
		}
		.lang {
			margin-top: 14px;
		}
		
	}

	@media only screen and (max-width: 565px){
		.logo img{
			padding-top: 2px;
			width: 45px;
		}
		#Home-nav{
			font-size: 10px;
		}
		.smallfont{
			font-size: 7px;
		}
		.alpha{
			margin-top : 10px;
			margin-bottom: 5px;
			margin-left: 45px;
		}
		.top-nav-group{
			overflow-y: scroll;
			width: 100%;
		}
		.top-nav-sub-group{
			width: 350px;
			padding-left: 26px;
			margin-top: 20px;
			margin-bottom: 6px;
			text-align:left !important;
		}
		#line0{
			margin-top: 0px;
			width: 75%;
		}
		#line0 p{
			color: #0061a5;
			font-size: 1px;
			padding-left: 1px;
		}
		#line1{
			width: 400px;
			margin-top: 1px;
		}
		#line2{
			margin-top: 2px;
		}
		p.tel-space{
			float: right !important;
			margin-bottom: 0px;
			padding-top: 10px;
			
		}
		.hundredinwidth{
			width: auto !important;
		}
		#activeNav{	
			top: 18px;
		}
		#topnav{
			height: 55px;
		}
		.searchresultcount{
			font-size: 10px;
		}
		.lang{
			margin-top: 7px;
		}
		.ui.breadcrumb{
			display: none;
		}
		.hideme{
			display: none;
		}
		#srchres{
			display: none;
		}
		#subcatmob{
			padding-bottom: 2px;
		}
		.topspace{
			padding-top: 5px;
			padding-bottom: 5px;
		}
		.mobilefil{
			display: block;
		}
		#mobilesubmenu{
			width: 150px;
		}
		.showmore{
			font-size: 10px;
		}
		.thumpimg{
			width: 150px;
		}
		.front.content{
			display: none;
		}
		div.ui.image.longy{
	    	overflow: scroll;
		}
		.fastdetails{
			position: relative;
		}
	}
</style>