var Tday = new Array();
var daysms = 24 * 60 * 60 * 1000
var hoursms = 60 * 60 * 1000
var Secondms = 60 * 1000
var microsecond = 1000
var DifferHour = -1
var DifferMinute = -1
var DifferSecond = -1
function clock(key,t)
  {
   var time = new Date()
   var hour = time.getHours()
   var minute = time.getMinutes()
   var second = time.getSeconds()
   var timevalue = ""+((hour > 12) ? hour-12:hour)
   timevalue +=((minute < 10) ? ":0":":")+minute
   timevalue +=((second < 10) ? ":0":":")+second
   timevalue +=((hour >12 ) ? " PM":" AM")
   var convertHour = DifferHour
   var convertMinute = DifferMinute
   var convertSecond = DifferSecond
   var Diffms = Tday[key].getTime() - time.getTime()
   DifferHour = Math.floor(Diffms / daysms)
   Diffms -= DifferHour * daysms
   DifferMinute = Math.floor(Diffms / hoursms)
   Diffms -= DifferMinute * hoursms
   DifferSecond = Math.floor(Diffms / Secondms)
   Diffms -= DifferSecond * Secondms
   var dSecs = Math.floor(Diffms / microsecond)

   if(convertHour != DifferHour) {   }
      var a = "<strong>"+DifferHour+"</strong>��";

   if(convertMinute != DifferMinute){}

   var b="<strong>"+DifferMinute+"</strong>ʱ";

   if(convertSecond != DifferSecond){}

   var c="<strong>"+DifferSecond+"</strong>��";

   var d="<strong>"+dSecs+"</strong>��";

     if (DifferHour>0) {var a=a}
     else {var a=''}
	// alert("ʣ��"+ a + b + c + d);
	if(t==0){
		if(key == 1122)
		{
			document.getElementById("leftTime"+key).innerHTML = a + b + c + d; //��ʾ����ʱ��Ϣ	
		}
		else
		{
			document.getElementById("leftTime"+key).innerHTML = "ʣ��"+ a + b + c + d; //��ʾ����ʱ��Ϣ
		}
  // document.getElementById("leftTime"+key).innerHTML = "��ɱ������ʼ"; //��ʾ����ʱ��Ϣ
	}else{
		if(key == 1122)
		{
			document.getElementById("leftTime"+key).innerHTML =a + b + c + d; //��ʾ����ʱ��Ϣ
		}
		else
		{
   			document.getElementById("leftTime"+key).innerHTML = "ʣ��"+ a + b + c + d; //��ʾ����ʱ��Ϣ
		}
	}

  }
