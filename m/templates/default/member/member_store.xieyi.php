<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/has.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/merchant.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/fonts/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/js/total.js"></script>


<section>
    <div class="headline">
      <h1>签订入驻协议</h1>
    </div>
    
    <div class="merchant">
      <p>入驻协议</p>
      <div class="agreement-box">
        <p>使用本公司服务所须遵守的条款和条件</p>
        <p class="mt">1.用户资格</p>
        <p>本公司的服务仅向适用法律下能够签订具有法律约束力的合同的个人提供并仅由其使用。在不限制前述规定的前提下，本公司的服务不向18周岁以下或被临时或无限期中止的用户提供。如您不合资格，请勿使用本公司的服务。此外，您的帐户（包括信用评价）和用户名不得向其他方转让或出售。另外，本公司保留根据其意愿中止或终止您的帐户的权利。</p>
        <p class="mt">2.您的资料（包括但不限于所添加的任何商品）不得：</p>
        <p>*具有欺诈性、虚假、不准确或具误导性；</p>
        <p>*侵犯任何第三方著作权、专利权、商标权、商业秘密或其他专有权利或发表权或隐私权；</p>
        <p>*违反任何适用的法律或法规（包括但不限于有关出口管制、消费者保护、不正当竞争、刑法、反歧视或贸易惯例/公平贸易法律的法律或法规）；</p>
        <p>*有侮辱或者诽谤他人，侵害他人合法权益的内容；</p>
        <p>*有淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的内容；</p>
        <p>*包含可能破坏、改变、删除、不利影响、秘密截取、未经授权而接触或征用任何系统、数据或个人资料的任何病毒、特洛依木马、蠕虫、定时炸弹、删除蝇、复活节彩蛋、间谍软件或其他电脑程序；</p>
        <p class="mt">3.违约</p>
        <p>如发生以下情形，本公司可能限制您的活动、立即删除您的商品、向本公司社区发出有关您的行为的警告、发出警告通知、暂时中止、无限期地中止或终止您的用户资格及拒绝向您提供服务：</p>
        <p>(a)您违反本协议或纳入本协议的文件；</p>
        <p>(b)本公司无法核证或验证您向本公司提供的任何资料；</p>
        <p>(c)本公司相信您的行为可能对您、本公司用户或本公司造成损失或法律责任。</p>
        <p class="mt">4.责任限制</p>
        <p>本公司、本公司的关联公司和相关实体或本公司的供应商在任何情况下均不就因本公司的网站、本公司的服务或本协议而产生或与之有关的利润损失或任何特别、间接或后果性的损害（无论以何种方式产生，包括疏忽）承担任何责任。您同意您就您自身行为之合法性单独承担责任。您同意，本公司和本公司的所有关联公司和相关实体对本公司用户的行为的合法性及产生的任何结果不承担责任。</p>
        <p class="mt">5.无代理关系</p>
        <p>用户和本公司是独立的合同方，本协议无意建立也没有创立任何代理、合伙、合营、雇员与雇主或特许经营关系。本公司也不对任何用户及其网上交易行为做出明示或默许的推荐、承诺或担保。</p>
        <p class="mt">6.一般规定</p>
        <p>本协议在所有方面均受中华人民共和国法律管辖。本协议的规定是可分割的，如本协议任何规定被裁定为无效或不可执行，该规定可被删除而其余条款应予以执行。</p>
      </div>

      <div class="holder">
             <div>      
                 <input type="checkbox" id="checkbox-1-1" class="regular-checkbox" checked="checked">
                 <label for="checkbox-1-1"></label>
                 <strong>我已阅读并同意以上协议</strong>                   
             </div>
             <a class="btn-enter" href="javascript:store_joinin_rz(1);">个人入驻</a>
             <a class="btn-enter" href="javascript:store_joinin_rz(2);">企业入驻</a>          
      </div>

    </div>

</section>


<script>
    
var check = 0;

var single_url = "<?php echo urlWap('member_store_joinin','single');?>";

var store_url = "<?php echo urlWap('member_store_joinin','store');?>";


function store_joinin_rz(type){

    check = $('input[type=checkbox]:checked').length;

    if(check === 1){

        if(type === 1){

            window.location.href=single_url + '&type=single';

        }else if(type === 2){

            window.location.href=store_url + '&type=store';

        }
        return;
    }else{
        alert('请阅读并同意以上协议');
        return;
    }

}


</script>