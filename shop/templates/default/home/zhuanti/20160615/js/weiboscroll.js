$(function () {
    var scrtime;

    var $ul = $("#art-con ul");
    var liFirstHeight = $ul.find("li:first").height();//��һ��li�ĸ߶�
    $ul.css({ top: "-" + liFirstHeight - 20 + "px" });//����css��top���Խ���һ��li�������б��Ϸ�	 ��li������padding:10px����Ҫ-20

    $("#art-con").hover(function () {
        $ul.pause();//��ͣ����
        clearInterval(scrtime);
    }, function () {
        $ul.resume();//�ָ����Ŷ���	
        scrtime = setInterval(function scrolllist() {
            //������ʽչ�ֵ�һ��li
            $ul.animate({ top: 0 + "px" }, 1500, function () {
                //�������ʱ
                $ul.find("li:last").prependTo($ul);//��ul�����һ������li����Ϊul�ĵ�һ��li
                liFirstHeight = $ul.find("li:first").height();//�ղ����li�ĸ߶�
                $ul.css({ top: "-" + liFirstHeight - 20 + "px" });//����css��top���Խ��ղ����li�������б��Ϸ�  ��li������padding:10px����Ҫ-20					
            });
        }, 5300);

    }).trigger("mouseleave");//ͨ��trigger("mouseleave")����������hover�¼��ĵ�2������

});