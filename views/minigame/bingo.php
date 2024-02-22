<?php
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/header.php');
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/navbar.php');
?>
<style>
@media screen and (min-width: 580px){
  main, .v-position-wheel {
      background: transparent;
      border-radius: 5px;
      margin-top: 13px;
      padding: 232px 63px 40px 104px;
      margin-bottom: 50px;
      width: 100%;
  }
  .v-bg-wheel {
      width: 720px;
      height: 630px;
      background-size: 720px 400px;
      position: relative;
  }
  
  #slot1, #slot2, #slot3, #slot4, #slot5 {
    display: inline-block;
    margin-top: 0px;
    margin-left: 4px;
    margin-right: -1px;
    background-size: 100px 93px;
    width: 100px;
    height: 93px;
    border-radius: 6px;
	}
}
				.a1{
            background-image: url("https://cdns.diongame.com/static/image-a25edaeb-50ed-48d0-aa7b-8b1ad0468e6a.png");
        }
                .a2{
            background-image: url("https://cdns.diongame.com/static/image-ccde65a8-a109-4b98-a26f-9121c5a2aa21.png");
        }
                .a3{
            background-image: url("https://cdns.diongame.com/static/image-f72138ff-a66c-42f5-86d1-a585fa99af8c.png");
        }
                .a4{
            background-image: url("https://cdns.diongame.com/static/image-77c3ea69-da0f-4040-81c6-aeaf04cf47e4.png");
        }
                .a5{
            background-image: url("https://cdns.diongame.com/static/image-9edbca30-b7cb-4314-87d4-d9e169012208.png");
        }
                .a6{
            background-image: url("https://cdns.diongame.com/static/image-734abb16-6d3e-4175-ab05-bf837c42bce4.png");
        }
                .a7{
            background-image: url("https://cdns.diongame.com/static/image-b9620370-d648-4f87-9497-f95c169396f7.png");
        }
                .a8{
            background-image: url("https://cdns.diongame.com/static/image-f72138ff-a66c-42f5-86d1-a585fa99af8c.png");
        }
                .a9{
            background-image: url("https://cdns.diongame.com/static/image-77c3ea69-da0f-4040-81c6-aeaf04cf47e4.png");
        }
                .a10{
            background-image: url("https://cdns.diongame.com/static/image-a25edaeb-50ed-48d0-aa7b-8b1ad0468e6a.png");
                }
</style>
<div class="tw-max-w-6xl tw-mx-auto md:tw-px-2 tw-my-8">
    <div class="tw-grid tw-grid-cols-12 tw-gap-4 tw-w-full tw-mb-8 tw-rounded tw-p-0 md:tw-p-2">
        <div class="tw-col-span-12 md:tw-col-span-8">
            <div class="tw-py-6 tw-bg-white tw-rounded">
                <h2 class="tw-game__title tw-uppercase tw-font-bold tw-text-2xl md:tw-text-3xl tw-px-2 md:tw-px-5 tw-text-center md:tw-text-left tw-mb-2">
                    MUA KEM GIẢI KHÁT
                </h2>
                <div class="tw-grid tw-grid-cols-12 tw-gap-2">
                    <div class="tw-col-span-5 md:tw-col-span-4 tw-py-2 md:tw-py-0 tw-pl-3 md:tw-pl-5 tw-roboto tw-text-sm tw-font-semibold">
                        <span class="tw-game__user-online tw-relative tw-inline-block tw-border-2 tw-border-green-400 tw-bg-green-100 tw-rounded tw-text-green-600 tw-px-2 tw-shadow">
                            Đang chơi: <?=rand(000,999)?>
                            <i class="tw-relative bx bxs-user" style="top: 1px;"></i>
                        </span>
                    </div>
                    <div class="tw-col-span-7 md:tw-col-span-8 tw-pr-3 md:tw-px-5 tw-roboto tw-text-sm tw-font-semibold tw-flex tw-items-center tw-justify-end">
                        <div>
                            <button class="tw-game__rule tw-relative tw-inline-block tw-border-2 tw-border-red-400 tw-bg-red-100 tw-rounded tw-text-red-600 tw-px-3 tw-mr-1 tw-uppercase tw-font-semibold tw-shadow">
                                Thể lệ
                            </button>
                            <button class="tw-game__history tw-relative tw-inline-block tw-border-2 tw-border-red-400 tw-bg-red-100 tw-rounded tw-text-red-600 tw-px-3 tw-uppercase tw-font-semibold tw-shadow">
                                Lịch sử
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tw-mb-8">
                    <div class="tw-receiver tw-px-3 md:tw-px-5">
                        <marquee class="tw-game__winner tw-relative tw-top-0 md:tw-top-2 tw-flex tw-items-center">
                            <span class="tw-game__list-winner-1 tw-mr-2 tw-text-sm tw-font-bold">
                                Danh sách trúng thưởng:
                            </span>
                        </marquee>
                    </div>
                </div>
                <div class="tw-grid tw-grid-cols-12 tw-gap-2">
                    <div class="tw-col-span-12 md:tw-col-span-6"><!----></div>
                    <div class="tw-col-span-12 md:tw-col-span-6"><!----></div>
                </div>
               <div data-v-00440bb7="" class="tw-mt-8 tw-flex tw-justify-center" id="boxfull">
                 <div data-v-00440bb7="" class="v-bg-wheel md:px-4 tw-relative game-list" style="margin-bottom: 20px; background-image: url('https://cdns.diongame.com/static/image-b55b8131-d4ec-465e-941d-8a9e32497025.png'); background-repeat: no-repeat;">
					<main data-v-52a19d74="" class="v-position-wheel">
                      <section data-v-52a19d74="" class="tw-block"></section>
                      <section data-v-52a19d74="" id="Slots" class="v-slot-wrap tw-relative tw-flex">
                          <div data-v-52a19d74="" id="slot1" class="a7"></div>
                          <div data-v-52a19d74="" id="slot2" class="a7"></div>
                          <div data-v-52a19d74="" id="slot3" class="a7"></div>
                          <div data-v-52a19d74="" id="slot4" class="a1"></div>
                          <div data-v-52a19d74="" id="slot5" class="a1"></div>
                      </section>
                  </main>
             <div data-v-00440bb7="" class="tw-w-full tw-mb-4"><div data-v-00440bb7="" class="tw-flex tw-justify-center">
               <select data-v-00440bb7="" id="numrolllop" class="
              tw-w-56
              tw-block
              tw-border-2
              tw-bg-white
              tw-border-yellow-500
              tw-h-10
              tw-px-3
              tw-rounded
              focus:tw-outline-none
            "><option value="1">
              Quay 1 lần - giá 15k
            </option><option value="3">
              Quay 3 lần - giá 43k
            </option><option value="5">
              Quay 5 lần - giá 70k
            </option><option value="7">
              Quay 7 lần - giá 100k
            </option><option value="10">
              Quay 10 lần - giá 140k
            </option></select></div></div> <div data-v-00440bb7="" class="my-4 tw-flex tw-justify-center">
                   <button data-v-52a19d74="" type="button" class="
            tw-rounded tw-text-white tw-transition tw-duration-200
            hover:tw-border-blue-700 hover:tw-bg-blue-700
            tw-border-2 tw-bg-blue-600 tw-border-blue-600
            focus:tw-outline-none
            tw-py-1 tw-px-4 tw-font-bold tw-mr-2 num-play-try
          ">
          Chơi thử
        </button>
                   <a data-v-00440bb7="" id="Gira" class="
            tw-transition tw-duration-200
            hover:tw-bg-red-700 hover:tw-border-red-700
            tw-bg-red-600
            tw-py-2
            tw-text-white
            tw-border-2
            tw-border-red-600
            tw-block
            tw-font-bold
            focus:tw-outline-none
            tw-w-40 tw-rounded tw-text-center
          " style="cursor: pointer;"><span data-v-00440bb7="" class="relative" style="top: 1px;"><i data-v-00440bb7="" class="tw-relative bx bxs-right-arrow" style="top: 2px;"></i>
            Chơi Ngay
          </span></a></div></div></div>
            </div>
        </div>
        <div class="tw-col-span-12 md:tw-col-span-4 tw-px-2">
            <!---->
            <div class="tw-mb-5">
                <div class="tw-bg-red-500 tw-text-white tw-font-semibold tw-py-2 tw-h-12 tw-rounded tw-uppercase tw-w-full tw-relative tw-text-center tw-flex tw-px-3 tw-justify-between tw-items-center">
                    <span class="tw-ml-1"> Nạp tiền </span>
                    <div>
                        <button class="tw-font-semibold tw-px-2 tw-py-1 tw-rounded tw-bg-white tw-text-gray-600 tw-text-sm tw-inline-flex tw-items-center">
                            <i class="tw-relative tw-text-base bx bxs-dollar-circle tw-mr-1" style="top: 0px; left: -1px;"></i>
                            Thẻ cào
                        </button>
                        <button class="tw-font-semibold tw-px-2 tw-py-1 tw-rounded tw-bg-white tw-text-gray-600 tw-text-sm tw-inline-flex tw-items-center" data-toggle="modal" data-target="#chargeModal">
                            <i class="tw-relative tw-text-base bx bxs-bank tw-mr-1" style="top: 0px; left: -1px;"></i>
                            Bank/Momo
                        </button>
                    </div>
                </div>
            </div>
            <div class="tw-mb-2">
                <h2 class="tw-text-xl tw-font-bold">CÓ THỂ BẠN QUAN TÂM</h2>
                <div class="tw-rounded">
                    <div class="tw-bg-gray-100 tw-py-2 md:tw-pb-4">
                        <div class="tw-grid tw-grid-cols-12 tw-gap-y-4">
                            <div class="tw-col-span-12 tw-bg-white tw-shadow-sm tw-rounded-b-sm tw-border md:tw-border-0 md:tw-rounded-b">
                                <a href="/tro-choi/vong-quay-tet-an-khang-53833c092a" class="">
                                    <div class="tw-col-span-5"><img class="tw-w-full tw-rounded-t-sm md:tw-rounded-t lazyLoad isLoaded" src="https://cdns.diongame.com/static/image-88e29fb7-e80b-402a-bee1-4795a8eb4524.gif" /></div>
                                    <div class="tw-col-span-12 tw-px-2 tw-py-3 tw-h-28 tw-relative">
                                        <h4 class="tw-sub-interface-title tw-uppercase tw-text-sm tw-font-semibold tw-text-gray-800 tw-mb-0">
                                            Vòng quay Tết an khang
                                        </h4>
                                        <div class="tw-my-1 tw-text-xs tw-text-gray-600 tw-sub-interface-info">
                                            <!---->
                                            <p>
                                                <span>
                                                    Đã chơi:
                                                    <b class="tw-text-red-500">399</b>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tw-absolute tw-bottom-2 tw-right-2 tw-left-2 tw-mt-2">
                                            <button class="eKJDZl tw-new tw-text-xs tw-border tw-px-1.5"><span> Dùng xu khóa để thử vận may nào ! </span></button>
                                            <!---->
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="tw-col-span-12 tw-bg-white tw-shadow-sm tw-rounded-b-sm tw-border md:tw-border-0 md:tw-rounded-b">
                                <a href="/tro-choi/lac-que-au-nam-9eabfaa0e8" class="">
                                    <div class="tw-col-span-5"><img class="tw-w-full tw-rounded-t-sm md:tw-rounded-t lazyLoad isLoaded" src="https://cdns.diongame.com/static/image-ce0ff61d-8a41-42b9-9459-e49e203d98ff.gif" /></div>
                                    <div class="tw-col-span-12 tw-px-2 tw-py-3 tw-h-28 tw-relative">
                                        <h4 class="tw-sub-interface-title tw-uppercase tw-text-sm tw-font-semibold tw-text-gray-800 tw-mb-0">
                                            Lắc quẻ đầu năm
                                        </h4>
                                        <div class="tw-my-1 tw-text-xs tw-text-gray-600 tw-sub-interface-info">
                                            <!---->
                                            <p>
                                                <span>
                                                    Đã chơi:
                                                    <b class="tw-text-red-500">408</b>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tw-absolute tw-bottom-2 tw-right-2 tw-left-2 tw-mt-2">
                                            <button class="eKJDZl tw-new tw-text-xs tw-border tw-px-1.5"><span> Dùng xu khóa để thử vận may nào ! </span></button>
                                            <!---->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-bottom-0 tw-flex tw-items-center tw-justify-center tw-p-2" id="noticeModal" role="dialog" style="z-index: 5000; background: rgba(93, 93, 93, 0.77); display: none; padding-right: 0px;" aria-modal="true">
    <div class="modal-dialog tw-max-w-md tw-w-full tw-rounded tw-shadow tw-bg-white">
        <div class="tw-relative tw-bg-red-600 tw-px-2 tw-py-1 tw-text-xl tw-text-white tw-font-bold tw-text-center tw-border-b tw-rounded-t">
            <span class="close tw-absolute tw-inline-block tw-px-3 tw-h-8 tw-w-8 tw-flex tw-items-center tw-justify-center tw-border-4 tw-border-white tw-text-sm tw-font-bold tw-rounded-full tw-cursor-pointer tw-py-1 tw-text-white tw-bg-gray-800" style="top: -15px; right: -5px; z-index: 100;" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x" data-dismiss="modal" aria-label="Close"></i>
            </span>
            <div class="tw-col-span-12 tw-py-3 tw-rounded-t tw-font-bold">
                Thông báo
            </div>
        </div>
        
        <div class="tw-p-3 tw-py-4 md:tw-p-4 tw-pb-8 md:tw-pb-8">
          <div class="content-popup"></div>
        </div>
    </div>                    
</div>
<script type="text/javascript">
  $(document).ready(()=>{
    var roll_check = true;
    var num_loop = 3;
    var num = 0;
	var numrollbyorder = -1;
    var num_current = 0;
    var target = 0;
    $('#Gira').click(function(){
        if(roll_check){
            typeRoll = "real";
			numrolllop = $("#numrolllop").val();
            num = 0;
			$("#boxfull .game-list").addClass("wheeling");
            num_current = 0;
            roll_check = false;
            $.ajax({
                url: '/test2.php',
                dataType:'json',
                data:{
					numrolllop,
					typeRoll,
					numrollbyorder
                },
                type: 'post',
                success: function (data) {
                    if(data.status=='ERROR'){
                        roll_check = true;
                        $('.content-popup').text(data.msg);
                        $('#noticeModal').modal('show');
                        return;
                    }
                    if(data.status=='LOGIN'){
                        location.href='/login';
                        return;
                    }
					numrollbyorder = parseInt(data.numrollbyorder) + 0;
					
                    gift_detail = data.msg;
                    gift_revice = data.arr_gift;
                    gift_total = data.total;
                    num_roll_remain = gift_detail.num_roll_remain;
					if(data.xgt > 0)
					{
						xvalue = data.xgt[data.xgt.length -1];
					}
					else
					{
						xvalue = 0;
					}
					xvalueaDD = data.xValue;
                    if(gift_detail.locale == 1){
                        var num1 = parseInt(gift_detail.pos)+1;
                        var num2 = randomExpert(1,10,num1,'999999');
                        var num3 = randomExpert(1,10,num1,num2);
						var num4 = randomExpert(1,10,num1,num2);
						var num5 = randomExpert(1,10,num1,num2);
                    }else{
                        var num1 = parseInt(gift_detail.pos)+1;
                        var num2 = parseInt(gift_detail.pos)+1;
                        var num3 = parseInt(gift_detail.pos)+1;
						var num4=0;
						var num5=0;
						if(xvalue == 1)
						{
							num4 = parseInt(gift_detail.pos)+1;
						}
						else
						{
							if(num1>4)
							{
							 num4 =  randomExpert(1,6,num1,'999999');
							}
							else
							{
								num4 =  randomExpert(4,10,num1,'999999');
							}
						}
						if(xvalue == 2)
						{
							num4 = parseInt(gift_detail.pos)+1;
							num5 = parseInt(gift_detail.pos)+1;
						}
						else
						{
							if(num1>4)
							{
							 num5 =  randomExpert(1,6,num1,'999999');
							}
							else
							{
								num5 =  randomExpert(4,10,num1,'999999');
							}
						}
                    }
					console.log("num1:"+num1);
                    doSlot(num1,num2,num3,num4,num5,num_roll_remain);
                },
                error: function(){
                    $('.content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
                    $('#noticeModal').modal('show');
                }
            })
        }
    })
    $('.num-play-try').click(function(){
        if(roll_check){
            typeRoll = "try";
            num = 0;
          	numrolllop = $("#numrolllop").val();
			$("#boxfull .game-list").addClass("wheeling");
            num_current = 0;
            roll_check = false;
            $.ajax({
                url: '/test2.php',
                dataType:'json',
                data:{
                  	numrolllop,
					typeRoll,
					numrollbyorder
                },
                type: 'post',
                success: function (data) {
                    if(data.status=='ERROR'){
                        roll_check = true;
                        $('.content-popup').text(data.msg);
                        $('#noticeModal').modal('show');
                        return;
                    }
                    if(data.status=='LOGIN'){
                        location.href='/login';
                        return;
                    }
					numrollbyorder = parseInt(data.numrollbyorder) + 0;
					
                    gift_detail = data.msg;
                    gift_revice = data.arr_gift;
                    gift_total = data.total;
                    num_roll_remain = gift_detail.num_roll_remain;
					if(data.xgt > 0)
					{
						xvalue = data.xgt[data.xgt.length -1];
					}
					else
					{
						xvalue = 0;
					}
					xvalueaDD = data.xValue;
                    if(gift_detail.locale == 1){
                        var num1 = parseInt(gift_detail.pos)+1;
                        var num2 = randomExpert(1,10,num1,'999999');
                        var num3 = randomExpert(1,10,num1,num2);
						var num4 = randomExpert(1,10,num1,num2);
						var num5 = randomExpert(1,10,num1,num2);
                    }else{
                        var num1 = parseInt(gift_detail.pos)+1;
                        var num2 = parseInt(gift_detail.pos)+1;
                        var num3 = parseInt(gift_detail.pos)+1;
						var num4=0;
						var num5=0;
						if(xvalue == 1)
						{
							num4 = parseInt(gift_detail.pos)+1;
						}
						else
						{
							if(num1>4)
							{
							 num4 =  randomExpert(1,6,num1,'999999');
							}
							else
							{
								num4 =  randomExpert(4,10,num1,'999999');
							}
						}
						if(xvalue == 2)
						{
							num4 = parseInt(gift_detail.pos)+1;
							num5 = parseInt(gift_detail.pos)+1;
						}
						else
						{
							if(num1>4)
							{
							 num5 =  randomExpert(1,6,num1,'999999');
							}
							else
							{
								num5 =  randomExpert(4,10,num1,'999999');
							}
						}
                    }
					console.log("num1:"+num1);
                    doSlot(num1,num2,num3,num4,num5,num_roll_remain);
                },
                error: function(){
                    $('.content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
                    $('#noticeModal').modal('show');
                }
            })
        }
    })

    function doSlot(one, two, three, four, five, num_roll_remain){
        document.getElementById("slot1").className='a1'
        document.getElementById("slot2").className='a1'
        document.getElementById("slot3").className='a1'
		document.getElementById("slot4").className='a1'
		document.getElementById("slot5").className='a1'
        var numChanges = randomInt(1,4)*10;
        var numeberSlot1 = numChanges+one;
        var numeberSlot2 = numChanges+2*10+two;
        var numeberSlot3 = numChanges+4*10+three;
		var numeberSlot4 = numChanges+6*10+four;
		var numeberSlot5 = numChanges+8*10+five;
        var i1 = 0;
        var i2 = 0;
        var i3 = 0;
		var i4 = 0;
		var i5 = 0;
        var sound = 0
        //status.innerHTML = "SPINNING"
        slot1 = setInterval(spin1, 50);
        slot2 = setInterval(spin2, 50);
        slot3 = setInterval(spin3, 50);
		slot4 = setInterval(spin4, 50);
		slot5 = setInterval(spin5, 50);
        function spin1(){
            i1++;
            if (i1>=numeberSlot1){
                clearInterval(slot1);
                return null;
            }
            slotTile = document.getElementById("slot1");
            if (slotTile.className=="a10"){
                slotTile.className = "a0";
            }
            slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
        }
        function spin2(){
            i2++;
            if (i2>=numeberSlot2){
                clearInterval(slot2);
                return null;
            }
            slotTile = document.getElementById("slot2");
            if (slotTile.className=="a10"){
                slotTile.className = "a0";
            }
            slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
        }
        function spin3(){
            i3++;
            if (i3>=numeberSlot3){
                clearInterval(slot3);
                return null;
            }
            slotTile = document.getElementById("slot3");
            if (slotTile.className=="a10"){
                slotTile.className = "a0";
            }
            slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
        }
		function spin4(){
            i4++;
            if (i4>=numeberSlot4){
                clearInterval(slot4);
                return null;
            }
            slotTile = document.getElementById("slot4");
            if (slotTile.className=="a10"){
                slotTile.className = "a0";
            }
			slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
        }
		function spin5(){
            i5++;
            if (i5>=numeberSlot5){
                clearInterval(slot5);
                testWin(one);
                return null;
            }
            slotTile = document.getElementById("slot5");
            if (slotTile.className=="a10"){
                slotTile.className = "a0";
            }
			slotTile.className = "a"+(parseInt(slotTile.className.substring(1))+1)
        }
    }
    
    

    function testWin(num1){
		//Check lại phần thưởng lần nữa
		if(xvalue == 0)
		{
			//Đổi class phần thưởng của 4,5 nếu trùng class phần thưởng nhận được(1)
			if($("#slot4").attr('class') == $("#slot1").attr('class'))
			{
				if(num1>4)
				{
					document.getElementById("slot4").className = "a"+(num1-1);
				}
				else
				{
					document.getElementById("slot4").className = "a"+(num1+1);
				}
			}
			if($("#slot5").attr('class') == $("#slot1").attr('class'))
			{
				
				if(num1>4)
				{
					document.getElementById("slot5").className = "a"+(num1-1);
				}
				else
				{
					document.getElementById("slot5").className = "a"+(num1+1);
				}
			}
		}
		if(xvalue == 1)
		{
			//Đổi class phần thưởng của 5 nếu trùng class phần thưởng nhận được(1)
			if($("#slot5").attr('class') == $("#slot1").attr('class'))
			{
				
				if(num1>4)
				{
					document.getElementById("slot5").className = "a"+(num1-1);
				}
				else
				{
					document.getElementById("slot5").className = "a"+(num1+1);
				}
			}
		}
        roll_check = true;
		if (gift_revice.length > 0) {
            $html = "";
            if (typeRoll == "real") {
                if (gift_revice.length == 1) {
                    $html += "<span>Kết quả: " + gift_revice[0]["title"] + ". Nhận được: " + gift_total + " kim cương</span><br/>";
                } else {
                    $html += "<span>Kết quả: Nhận " + gift_revice.length + " phần thưởng cho " + gift_revice.length + " lượt quay.</span><br/>";
                    $html += "<span><b>Mua X" + gift_revice.length + ":</b></span><br/>";
                    for ($i = 0; $i < gift_revice.length; $i++) {
                        $html += "<span>Lần quay " + ($i + 1) + ": " + gift_revice[$i]["title"];
                        $html += "<br/>";
                    }

                    $html += "<span><b>Tổng cộng: " + gift_total + "</b></span>";
                }
            } else {
                if (gift_revice.length == 1) {
                    $html += "<span>Kết quả chơi thử: " + gift_revice[0]["title"] + ". Nhận được: " + gift_total + " kim cương</span><br/>";
                } else {
                    $html += "<span>Kết quả chơi thử: Nhận " + gift_revice.length + " phần thưởng cho " + gift_revice.length + " lượt quay.</span><br/>";
                    $html += "<span><b>Mua X" + gift_revice.length + ":</b></span><br/>";
                    for ($i = 0; $i < gift_revice.length; $i++) {
                        $html += "<span>Lần quay " + ($i + 1) + ": " + gift_revice[$i]["title"];
                        $html += "<br/>";
                    }

                    $html += "<span><b>Tổng cộng: " + gift_total + "</b></span>";
                }
            }
        }
        $('.content-popup').html($html);
		$("#boxfull .game-list").removeClass("wheeling");
        $('#noticeModal').modal('show');
    }

    function randomExpert(min, max, expert, expert1){
        var value = Math.floor((Math.random() * (max-min+1)) + min);
        if(value == expert){
            randomExpert(min, max, expert, expert1);
        }
        if(value == expert1){
            randomExpert(min, max, expert, expert1);
        }
        return value;
    }

    function randomInt(min, max){
        return Math.floor((Math.random() * (max-min+1)) + min);
    }
  })
</script>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/views/footer.php'); ?>