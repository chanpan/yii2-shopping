<div id="calhead" class="nonborderbox" style="padding-left:1px;padding-right:1px;">               

	<div id="caltoolbar" class="ctoolbar">

		<div>
			<div class="gbtn">
				<div id="faddbtn" class="btn btn-primary" style="<?=$readonly?'display: none;':'';?>">สร้าง</div>
				<div id="showtodaybtn" class="btn btn-default">วันนี้</div>

			</div>
			<div class="tsbtn"> 
				<div id="sfprevbtn" title="ช่วงเวลาก่อนหน้า"  class="btn btn-default btnl">
					<i class="glyphicon glyphicon-chevron-left"></i>
				</div>
				<div id="sfnextbtn" title="ช่วงเวลาถัดไป" class="btn btn-default btnr">
					<i class="glyphicon glyphicon-chevron-right"></i>
				</div>
			</div>


            <div class="fshowdatep fbutton">

				<input type="hidden" name="txtshow" id="hdtxtshow" />
				<span id="txtdatetimeshow">Loading</span>


            </div>

		</div>

		<div class="sbtn">
			<div  id="showreflashbtn" class="btn btn-default refresh"><i class="glyphicon glyphicon-repeat"></i></div>
		</div>

		<div class="tbtn"> 
			<div id="showdaybtn" class="btn btn-default btnl">วัน</div>
			<div  id="showweekbtn" class="btn btn-default btnm">สัปดาห์</div>
			<div  id="showmonthbtn" class="btn btn-default btnr">เดือน</div>
		</div>

		<div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Loading data...</div>
		<div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Sorry, could not load your data, please try again later</div>
		<div class="clear"></div>
	</div>
</div>

<div id="dvCalMain" class="calmain printborder nonborderbox">
	<div id="gridcontainer" style="overflow-y: visible;">
	</div>
</div>
